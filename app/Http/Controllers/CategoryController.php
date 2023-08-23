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
        return view('admin.categories.list',compact(['data_categories']));
    }

    public function add_form()
    {
        return view('admin.categories.add_category');
    }
    public function add_to_db(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $data_entered=[
            'name'=>$request->name,
            'description'=>$request->description,
            'created_at'=>date('Y-m-d')
        ];

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
            'name' => 'required',
            'description' => 'required',
        ]);

        $data_entered=[
            'name'=>$request->name,
            'description'=>$request->description,
            'updated_at'=>date('Y-m-d')
        ];

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
