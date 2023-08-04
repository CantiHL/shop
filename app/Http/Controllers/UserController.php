<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Comment;
use App\Models\Cart;
use Mail;

class UserController extends Controller
{
    private $user;
    private $product;
    private $category;
    private $brand;
    private $comment;
    private $cart;
    public function __construct()
    {
        $this->user=new User();
        $this->product=new Product();
        $this->category=new Category();
        $this->brand=new Brand();
        $this->cart=new Cart();
        $this->comment=new Comment();
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
            //'email'=> 'required|email|unique:users',
            'password'=> 'required',
            'address'=> 'required',
            'phone'=> 'required'
        ]);
        $data=[
            'user_name'=>$request->user_name,
            'email'=>$request->email,
            'password'=>md5($request->password),
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
        $data=[
            'email'=>$request->email_login,
            'password'=>md5($request->password_login)
        ];

        $user=$this->user->login($data);

        if($user){
            if ($user->position===0) {
                $request->session()->put('id', $user->id);
                $request->session()->put('user_name', $user->user_name);
                return redirect()->route('dashboard');
            }else{
                $request->session()->put('id', $user->id);
                $request->session()->put('user_name', $user->user_name);
                return redirect()->route('client_home');
            }
        }

         return back()->with('message1','Email or Password is Incorrect');
    }
    public function logout(Request $request){

            $request->session()->forget('id');
            $request->session()->forget('user_name');
            return redirect()->route('login');

    }

    public function comment(Request $request)
    {
       $data=[
        'user_id'=>session('id'),
        'comment_content'=>$request->comment,
        'created_at'=>date('Y-m-d H:i:s')
       ];
       $this->comment->insert_comment($data);
      // return back();
    }
    // public function account($id)
    // {
    //    $data=$this->user->listuser($id);
    //    return view('account', compact('data'));
    // }
    // public function update_account(Request $request)
    // {
        // $id=$request->id;
        // $data=[
        //     'user_name'=>$request->user_name,
        //     'email'=>$request->email,
        //     'phone'=>$request->phone,
        //     'address'=>$request->address
        // ];
        // $this->user->update_user($id,$data);
        // return back()->with('message_success','Update Successfully');
    //}
    public function checkout(Request $request)
    {
       $email="";
        $data=array();
        $cart=session()->get('cart');
            foreach($cart as $key){
                if (session()->has('id')) {
                    $id_user=session('id');
                    $user=User::find($id_user);
                    $email=$user->email;
                    $data=[
                    'id_product'=>$key['id'],
                    'id_customer'=>$id_user,
                    'quantity'=>$key['quantity'],
                    'name'=>$user->user_name,
                    'phone'=>$user->phone,
                    'email'=>$email,
                    'address'=>$user->address,
                    'note'=>$request->note,
                    'created_at'=>date('Y-m-d H:i:s')
                ];
                }else{
                    $email=$request->cus_email;
                     $request->validate([
                        'cus_name'=>'required|min:2',
                        'cus_phone'=>'required',
                        'cus_address'=>'required'
                    ],[
                        'cus_name.required'=>'Enter your name Please!',
                        'cus_name.min'=>'Enter your real Name Please!',
                        'cus_phone.required'=>'Enter your phone Please!',
                        'cus_email.required'=>'Enter your phone Please!',
                        'cus_address.required'=>'Enter your address Please!'
                    ]);
                    $data=[
                        'id_product'=>$key['id'],
                        'quantity'=>$key['quantity'],
                        'name'=>$request->cus_name,
                        'phone'=>$request->cus_phone,
                        'email'=>$email,
                        'address'=>$request->cus_address,
                        'note'=>$request->note,
                        'created_at'=>date('Y-m-d H:i:s')
                    ];
                }
           $this->cart->insert_cart($data);

                session()->flash('message_success','Dear Customer. You Just check out success! Your package is preparing');
            }
            session()->forget('cart');
            return back();
    }
    public function sendemail()
    {
        $name='hung';
        Mail::send('emails.order',compact('name'),function ($email) use($name){
            $email->subject('Thank');
            $email->to('cccanti.hl@gmail.com',$name);
        });
    }
}
