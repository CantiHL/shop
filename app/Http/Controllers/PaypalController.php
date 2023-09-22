<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Omnipay\Omnipay;
use Mail;

class PaypalController extends Controller
{
    private $gateway;
    public function __construct(
        private readonly Payment $payment,
        private readonly Order $order,
        private readonly Config $config,
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
                'returnUrl'=>route('success',['note'=>$request->note]),
                'cancelUrl'=>route('cancel')
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
                    'sale_id'=>$arr['transactions'][0]['related_resources'][0]['sale']['id'],
                    'payer_email'=>$arr['payer']['payer_info']['email'],
                    'amount'=>$arr['transactions'][0]['amount']['total'],
                    'currency'=>env('PAYPAL_CURRENCY'),
                    'payment_status'=>$arr['state'],
                    'created_at'=>now(),
                ];
                $paymentID=$this->payment->insert($data);
                $this->checkoutInfor($paymentID,$request->note);
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
    public function refund(Request $request)
    {
        $saleId = $request->input('sale_id');
        $amount=$request->input('amount');
       $transaction = $this->gateway->refund(array(
           'amount'    => $amount,
            'transactionId' => $saleId,
            'currency'  => 'USD',
        ));
        $transaction->setTransactionReference($saleId);
        $response = $transaction->send();
        if ($response->isSuccessful()) {
           return "Refund transaction was successful!\n";
       }else{
            return "Refund transaction was failure!\n";
        }
    }
    public function checkoutInfor($paymentID, $note)
    {
        $email = null;
        $name = null;
        $carts = session()->get('cart');
        foreach ($carts as $cart) {
                $id_user = session('id');
                $user = User::find($id_user);
                $email = $user->email;
                $name = $user->user_name;
                $data = [
                    'product_id' => $cart['id'],
                    'user_id' => $id_user,
                    'quantity' => $cart['quantity'],
                    'name' => $name,
                    'phone' => $user->phone,
                    'email' => $email,
                    'address' => $user->address,
                    'note' => $note,
                    'payment_id' => $paymentID,
                    'created_at' => date('Y-m-d H:i:s')
                ];
            $this->order->insertOrder($data);
        }
        Mail::send('emails.order',compact('carts'),function ($mail) use($name, $email){
            $mail->subject('Thanks');
            $mail->to($email,$name);
        });
        session()->forget('cart');
    }

}
