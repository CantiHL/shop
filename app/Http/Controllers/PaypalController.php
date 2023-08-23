<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Omnipay\Omnipay;

class PaypalController extends Controller
{
    private $gateway;
    public function __construct(
        private readonly Payment $payment,
        private readonly Order $order
    )
    {
        $this->gateway=Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }
    public function pay(Request $request)
    {
        try {
            $response=$this->gateway->purchase(array(
                'amount'=>$request->amount,
                'currency'=>env('PAYPAL_CURRENCY'),
                'returnUrl'=>route('success',['ordersID'=>$request->orderID]),
                'cancelUrl'=>route('error')
            ))->send();

            if ($response->isRedirect()){
                $response->redirect();
            }else{
                return $response->getMessage();
            }

        }catch(\Throwable $th){
            return $th->getMessage();
        }
    }

    public function success(Request $request){
        if ($request->input('paymentId')&&$request->input('PayerID')){
            $transaction=$this->gateway->completePurchase(array(
                'payerId'=>$request->input('PayerID'),
                'transactionReference'=>$request->input('paymentId')

            ));
            $response=$transaction->send();
            if($response->isSuccessful()){
                $arr=$response->getData();
                $data=[
                    'payment_id'=>$arr['id'],
                    'payer_id'=>$arr['payer']['payer_info']['payer_id'],
                    'payer_email'=>$arr['payer']['payer_info']['email'],
                    'amount'=>$arr['transactions'][0]['amount']['total'],
                    'currency'=>env('PAYPAL_CURRENCY'),
                    'payment_status'=>$arr['state'],
                    'created_at'=>now(),
                ];
                $paymentID=$this->payment->insert($data);
                foreach ($request->ordersID as $orderID){
                    $this->order->updatePaymentId((int)$orderID,$paymentID);
                }
                return "thanks for use our website. Your just purchase successfull. your transaction id is: ".$arr['id']." click <a href='".route('client_home')."'>click here</a> to redirect homepage";
            }else{
                $response->getMessage();
            }

        }else{
            return "Payment is declined!";
        }
    }

    public function error(){
        return "something went wrong ";
    }
}
