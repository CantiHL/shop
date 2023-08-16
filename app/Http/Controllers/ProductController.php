<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

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
        $data_products=$this->product->list();
        return view('admin.products.product_list',compact(['data_products']));
    }

     public function add_form()
    {
        $data_brands=$this->brand->list_active();
        $data_categories=$this->category->list_active();
        return view('admin.products.add_product',compact(['data_brands','data_categories']));
    }
    public function add_to_db(Request $request)
    {
        $request->validate([
            'product_name' => 'required|min:3',
            'product_price' => 'required|integer',
            'product_brand_id' => 'required',
            'product_category_id' => 'required',
            'product_date' => 'required',
        ]);

        $data_entered=[
            'product_name'=>$request->product_name,
            'product_price'=>$request->product_price,
            'product_brand_id'=>$request->product_brand_id,
            'product_category_id'=>$request->product_category_id,
            'product_description'=>$request->product_description,
            'product_date'=>$request->product_date
        ];
        $product_image=$request->file('product_image');
        if ($product_image) {
             $image_extenion=$product_image->extension();
             $image_name=time() .rand(0,1000).'.'.$image_extenion;
             $data_entered['product_image']=$image_name;
             $product_image->move(public_path('assets/img/products'),$image_name);
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
            if (file_exists(public_path('assets/img/products/'.$productImg->product_image))){
                unlink(public_path('assets/img/products/'.$productImg->product_image));
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
        $data_brands=$this->brand->list_active();
        $data_categories=$this->category->list_active();
        return view('admin.products.update_product',compact(['info_product','data_brands','data_categories']));
    }
    public function update_to_db(Request $request,$id)
    {
        //dd($request->input());

        $request->validate([
            'product_name' => 'required',
            'product_price' => 'required|integer',
            'product_date' => 'required',
            'product_description'=>'required',
        ]);

        $data_entered=[
            'product_name'=>$request->product_name,
            'product_price'=>$request->product_price,
            'product_brand_id'=>$request->product_brand_id,
            'product_category_id'=>$request->product_category_id,
            'product_description'=>$request->product_description,
            'product_date'=>$request->product_date
        ];
        if ($product_image=$request->file('product_image')) {
            $productImg=Product::find($id);
             $image_extenion=$product_image->extension();
             $image_name=rand(0,1000).'.'.$image_extenion;
             $data_entered['product_image']=$image_name;
             $product_image->move(public_path('assets/img/products'),$image_name);
            if (file_exists(public_path('assets/img/products/'.$productImg->product_image))){
                unlink(public_path('assets/img/products/'.$productImg->product_image));
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
       $data=$this->product->get_product_detail($id);
       return view('clients.product.product_detail',compact('data'));
    }
}
