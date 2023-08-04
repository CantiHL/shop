<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $brand;
    public function __construct()
    {
        $this->brand=new Brand();
    }
    public function index()
    {
        $data_brands=$this->brand->list();
        return view('admin.brands.brand_list',compact(['data_brands']));
    }
    public function update_status_brand($id,$value){
        $this->brand->updateStatus($id,$value);
        return back();
    }
    public function add_form()
    {
        return view('admin.brands.add_brand');
    }
    public function add_to_db(Request $request)
    {
        $request->validate([
            'brand_name' => 'required',
            'brand_description' => 'required',
        ]);

        $data_entered=[
            'brand_name'=>$request->brand_name,
            'brand_image'=>$request->brand_image,
            'brand_description'=>$request->brand_description,
            'created_at'=>date('Y-m-d')
        ];
        if ($brand_image=$request->file('brand_image')) {
             $image_extenion=$brand_image->extension();
             $image_name=rand(0,1000).'.'.$image_extenion;
             $data_entered['brand_image']=$image_name;
             $brand_image->move(public_path('assets/img/brands'),$image_name);
        }
        if ($data_entered) {
            if ($this->brand->insert($data_entered)) {
                $request->session()->flash('message', 'Insert brand To DB Success');
                return back();
            } else {
                 $request->session()->flash('message', 'Insert brand To DB Unuccess. Please check your enter infor');
                 return back();
            }

        }
    }
    public function update_form($id)
    {
        $info_brand=$this->brand->listId($id);
        return view('admin.brands.update_brand',compact(['info_brand']));
    }
    public function update_to_db(Request $request,$id)
    {
        $request->validate([
            'brand_name' => 'required',
            'brand_description' => 'required',
        ]);

        $data_entered=[
            'brand_name'=>$request->brand_name,
            'brand_image'=>$request->brand_image,
            'brand_description'=>$request->brand_description,
            'updated_at'=>date('Y-m-d')
        ];
        if ($brand_image=$request->file('brand_image')) {
             $image_extenion=$brand_image->extension();
             $image_name=rand(0,1000).'.'.$image_extenion;
             $data_entered['brand_image']=$image_name;
             $brand_image->move(public_path('assets/img/brands'),$image_name);
        }
        if ($data_entered) {
            if ($this->brand->updateById($data_entered,$id)) {
                 $request->session()->flash('message', 'Update brand To DB Success');
                 return back();
            } else {
                $request->session()->flash('message', 'Update brand To DB Unuccess. Please check your enter infor');
                return back();
            }

        }
    }
    public function delete_brand(Request $request,$id)
    {
        $this->brand->deleteById($id);
            $request->session()->flash('message', 'Delete success');
            return back();


    }
}
