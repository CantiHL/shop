<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(
        private readonly Category $category,
        private readonly Product $product,
        private readonly Brand $brand
    )
    {
    }

    public function index(Request $request)
    {
        $filters=[];
        $keywods=null;
        if (!empty($request->filter_category)) {
            $categoryId=$request->filter_category;
            $filters['product_category_id']=$categoryId;
        }
        if (!empty($request->filter_brand)) {
            $brandId=$request->filter_brand;
            $filters['product_brand_id']=$brandId;
        }
        if (!empty($request->keywords)) {
            $keywods=$request->keywords;
        }
        $data_products=$this->product->list_show($filters,$keywods);
        $data_categories=$this->category->list();
        $data_brands=$this->brand->list();
        return view('clients.content',compact(['data_products','data_categories','data_brands']));
    }
}
