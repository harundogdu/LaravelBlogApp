@extends('front.layouts.master')
@section('title',$category->name)
@section('mainTitle',$category->name . ' | ' . $category->getActiveArticleCount() . ' aktif yazı bulundu.')
@section('content')
      <div class="col-lg-9 col-md-10 mx-auto">
        @include('front.widgets.articleListWidget')
      </div>
      @include('front.widgets.categoryWidget')
@endsection