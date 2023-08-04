<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $category;
    public function __construct()
    {
        $this->category=new Category();
    }
    public function index()
    {
        $data_categories=$this->category->list();
        return view('admin.categories.category_list',compact(['data_categories']));
    }

    public function add_form()
    {
        return view('admin.categories.add_category');
    }
    public function add_to_db(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'category_description' => 'required',
        ]);

        $data_entered=[
            'category_name'=>$request->category_name,
            'category_image'=>$request->category_image,
            'category_description'=>$request->category_description,
            'created_at'=>date('Y-m-d')
        ];
        if ($category_image=$request->file('category_image')) {
             $image_extenion=$category_image->extension();
             $image_name=rand(0,1000).'.'.$image_extenion;
             $data_entered['category_image']=$image_name;
             $category_image->move(public_path('assets/img/categories'),$image_name);
        }
        if ($data_entered) {
            if ($this->category->insert($data_entered)) {
                $request->session()->flash('message', 'Insert category To DB Success');
                return back();
            } else {
                 $request->session()->flash('message', 'Insert category To DB Unuccess. Please check your enter infor');
                 return back();
            }

        }
    }
    public function update_status_category($id,$value){
        $this->category->updateStatus($id,$value);
        return back();
    }
    public function update_form($id)
    {
        $info_category=$this->category->listId($id);
        return view('admin.categories.update_category',compact(['info_category']));
    }

    public function update_to_db(Request $request,$id)
    {
        $request->validate([
            'category_name' => 'required',
            'category_description' => 'required',
        ]);

        $data_entered=[
            'category_name'=>$request->category_name,
            'category_image'=>$request->category_image,
            'category_description'=>$request->category_description,
            'updated_at'=>date('Y-m-d')
        ];
        if ($category_image=$request->file('category_image')) {
             $image_extenion=$category_image->extension();
             $image_name=rand(0,1000).'.'.$image_extenion;
             $data_entered['category_image']=$image_name;
             $category_image->move(public_path('assets/img/categories'),$image_name);
        }
        if ($data_entered) {
            if ($this->category->updateById($data_entered,$id)) {
                 $request->session()->flash('message', 'Update category To DB Success');
                 return back();
            } else {
                $request->session()->flash('message', 'Update category To DB Unuccess. Please check your enter infor');
                return back();
            }

        }
    }
    public function delete_category(Request $request,$id)
    {
        $this->category->deleteById($id);
        $request->session()->flash('message', 'Delete success');
        return back();
    }
}
