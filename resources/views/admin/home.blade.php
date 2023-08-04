@extends('layouts.admin_layout')
@section('content')
@if (session('message'))
    <p class="alert-info text-center">{{ session('message') }}</p>
@endif            
    <h1 class="text-center" >{{$title}}</h1>
@stop