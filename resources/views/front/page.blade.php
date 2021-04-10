@extends('front.layouts.master')
@section('title',$page->title)
@section('mainTitle',$page->title)
@section('bg',$page->image)
@section('content')
    <div class="col-md-10 mx-auto">
        {!! $page->content !!}
    </div>
@endsection