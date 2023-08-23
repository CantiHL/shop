<?php

namespace App\Http\Controllers;
session_start();
class AdminController extends Controller
{
    public function index()
    {
      $title="Welcome To Admin Dashboard";
      return view('admin.home',compact('title'));
    }
}
