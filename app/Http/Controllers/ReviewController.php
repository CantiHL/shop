<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct(private readonly Review $review)
    {
    }

    public function review(Request $request)
    {
        $data=[
            'user_id'=>session('id'),
            'product_id'=>$request->product_id,
            'content'=>$request->rv_content,
            'rating'=>$request->rating,
            'created_at'=>date('Y-m-d H:i:s')
        ];
        $this->review->insert($data);
        return back();
    }
}
