<?php

namespace App\Http\Controllers;

use App\Imports\ProductsImport;
use App\Models\Review;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use Maatwebsite\Excel\Facades\Excel;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $product;
    private $category;
    private $brand;

    public function __construct()
    {
        $this->product=new Product;
        $this->category=new Category();
        $this->brand=new Brand();
    }
    public function index()
    {
        $data_products=Product::with('brand')->with('category')->get();
        return view('admin.products.list',compact(['data_products']));
    }

     public function add_form()
    {
        $data_brands=$this->brand->list();
        $data_categories=$this->category->list();
        return view('admin.products.add_product',compact(['data_brands','data_categories']));
    }
    public function add_to_db(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'price' => 'required|integer',
            'brand_id' => 'required',
            'image' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'quantity' => 'required',
        ]);

        $data_entered=[
            'name'=>$request->name,
            'price'=>$request->price,
            'brand_id'=>$request->brand_id,
            'category_id'=>$request->category_id,
            'description'=>$request->description,
            'quantity'=>$request->quantity,
            'created_at'=>now(),
        ];
        $image=$request->file('image');
        if ($image) {
             $image_extenion=$image->extension();
             $image_name=time() .rand(0,1000).'.'.$image_extenion;
             $data_entered['image']=$image_name;
             $image->move(public_path('assets/img/products'),$image_name);
        }
        $this->product->insert($data_entered);
        $request->session()->flash('message', 'Add Product To DB Success');
        return back();
    }
     public function delete_product(Request $request,$id)
    {
        $productImg=Product::find($id);
        if ($this->product->deleteById($id)) {
            $request->session()->flash('message', 'Delete success');
            if (file_exists(public_path('assets/img/products/'.$productImg->image))){
                unlink(public_path('assets/img/products/'.$productImg->image));
            }
            return back();
        } else {
            $request->session()->flash('message', 'Error');
            return back();
            }
        }

    public function update_form($id)
    {
        $info_product=$this->product->listId($id);
        $data_brands=$this->brand->list();
        $data_categories=$this->category->list();
        return view('admin.products.update_product',compact(['info_product','data_brands','data_categories']));
    }
    public function update_to_db(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'description'=>'required',
            'quantity' => 'required',
        ]);

        $data_entered=[
            'name'=>$request->name,
            'price'=>$request->price,
            'brand_id'=>$request->brand_id,
            'category_id'=>$request->category_id,
            'description'=>$request->description,
            'quantity'=>$request->quantity,
            'created_at'=>now(),
        ];
        if ($image=$request->file('image')) {
            $productImg=Product::find($id);
             $image_extenion=$image->extension();
             $image_name=rand(0,1000).'.'.$image_extenion;
             $data_entered['image']=$image_name;
             $image->move(public_path('assets/img/products'),$image_name);
            if (file_exists(public_path('assets/img/products/'.$productImg->image))){
                unlink(public_path('assets/img/products/'.$productImg->image));
            }
        }

        $this->product->updateById($data_entered,$id);
        $request->session()->flash('message', 'Update Product To DB Success');
        return redirect()->route('product_list');
    }
    public function update_status_product($id,$value){
        $this->product->updateStatus($id,$value);
        return back();
    }
    public function product_detail($id){
//        DB::enableQueryLog();
        $data=Product::with(['brand','category'])->where('id',$id)->get();
        $reviews=Review::with(['user','product'])->whereHas('product',function ($q) use ($id){
            $q->where('id',$id);
        })->get();
//        dd($reviews);
//        dd(DB::getQueryLog($reviews));
       return view('clients.product.product_detail',compact(['data','reviews']));
    }
    public function import(Request $request){
        $path = $request->file('file_import')->getRealPath();
        Excel::import(new ProductsImport, $path);
        return back()->with('message','success');
    }

}
