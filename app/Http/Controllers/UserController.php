<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Comment;
use App\Models\Cart;
use Illuminate\Support\Facades\Hash;
use Mail;

class UserController extends Controller
{
    private $user;
    private $product;
    private $category;
    private $brand;
    public function __construct(
        private readonly Order $order,
        private readonly PaypalController $paypalController,
        private readonly Comment $comment
    )
    {
        $this->user=new User();
        $this->product=new Product();
        $this->category=new Category();
        $this->brand=new Brand();
    }
    public function index(Request $request)
    {

        $filters=[];
        $keywods=null;
        if (!empty($request->filter_category)) {
            $categoryId=$request->filter_category;
            $filters[]=['product_category_id',$categoryId];
        }
        if (!empty($request->filter_brand)) {
            $brandId=$request->filter_brand;
            $filters[]=['product_brand_id',$brandId];
        }
        if (!empty($request->keywords)) {
            $keywods=$request->keywords;
        }
        $data_products=$this->product->list_for_client($filters,$keywods);
        $data_categories=$this->category->list_active();
        $data_brands=$this->brand->list_active();
        $data_comments=$this->comment->list_comment();
        return view('clients.content',compact(['data_products','data_categories','data_brands','data_comments']));
    }

     public function register(Request $request)
    {
        $request->validate([
            'user_name'=> 'required',
            'email'=> 'required|email|unique:users',
            'password'=> 'required',
            'address'=> 'required',
            'phone'=> 'required'
        ]);
        $data=[
            'user_name'=>$request->user_name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'address'=>$request->address,
            'phone'=>$request->phone,
            'created_at'=>date('Y-m-d H:i:s')
        ];
        $this->user->register($data);
        $request->session()->flash('message', 'register success');
        return back();

    }
    public function login()
    {
        return view('login');
    }
    public function check(Request $request)
    {

        $request->validate([
            'email_login'=> 'required',
            'password_login'=> 'required'
        ]);
        $email=$request->email_login;
        $password=$request->password_login;

        $user=$this->user->getUserByEmail($email);

        if($user){
            if (Hash::check($password,$user->password)){
                if ($user->position===0) {
                    $request->session()->put('id', $user->id);
                    $request->session()->put('user_name', $user->user_name);
                    return redirect()->route('dashboard');
                }else{
                    $request->session()->put('id', $user->id);
                    $request->session()->put('user_name', $user->user_name);
                    return redirect()->route('client_home');
                }
            }else{
                return back()->with('message1','Incorrect Password');
            }
        }
         return back()->with('message1','Email or Password is Incorrect');
    }
    public function logout(Request $request){

            $request->session()->forget('id');
            $request->session()->forget('user_name');
            return redirect()->route('login');

    }


     public function account()
     {
         $user=$this->user->getUserById(session('id'));
        return view('account', compact('user'));
     }
     public function update_account(Request $request)
     {
         $id=session('id');
         $request->validate([
             'name'=>'required',
             'email'=>'required|email|unique:users,email,'.$id,
             'phone'=>'required',
             'address'=>'required',

         ]);
         $data=[
             'user_name'=>$request->name,
             'email'=>$request->email,
             'phone'=>$request->phone,
             'address'=>$request->address
         ];
         $this->user->update_user($id,$data);
         return back()->with('message_success','Update Successfully');
    }
    public function checkout(Request $request)
    {
        $email=null;
        $name=null;
        $data=array();
        $productID=array();
        $quantity=[];
        $carts=session()->get('cart');
        foreach ($carts as $cart){
            $productID[]=$cart['id'];
            $quantity[]=$cart['quantity'];
        }
        if (session()->has('id')) {
            $id_user=session('id');
            $user=User::find($id_user);
            $email=$user->email;
            $name=$user->user_name;
            $data=[
            'id_product'=>json_encode($productID),
            'quantity'=>json_encode($quantity),
            'name'=>$name,
            'phone'=>$user->phone,
            'email'=>$email,
            'address'=>$user->address,
            'note'=>$request->note,
            'total'=>$request->amount,
            'created_at'=>date('Y-m-d H:i:s')
        ];
        }else{
            $email=$request->cus_email;
            $name=$request->cus_name;
             $request->validate([
                'cus_name'=>'required|min:2',
                'cus_phone'=>'required',
                'cus_address'=>'required',
                 'cus_email'=>'required|email'
            ],[
                'cus_name.required'=>'Enter your name Please!',
                'cus_name.min'=>'Enter your real Name Please!',
                'cus_phone.required'=>'Enter your phone Please!',
                'cus_email.required'=>'Enter your email Please!',
                 'cus_email.email'=>'Enter your correct email!',
                'cus_address.required'=>'Enter your address Please!'
            ]);
            $data=[
                'id_product'=>json_encode($productID),
                'quantity'=>json_encode($quantity),
                'name'=>$name,
                'phone'=>$request->cus_phone,
                'email'=>$email,
                'address'=>$request->cus_address,
                'note'=>$request->note,
                'total'=>$request->amount,
                'created_at'=>date('Y-m-d H:i:s')
            ];
        }
        $orderID=$this->order->insertOrder($data);

        if ($request->input('payment_method')==='paypal'){
            $this->paypalController->pay($request,$orderID);
        }

        Mail::send('emails.order',compact('name'),function ($mail) use($name, $email){
            $mail->subject('Thanks');
            $mail->to($email,$name);
        });

        session()->forget('cart');
        return back();
    }

}
