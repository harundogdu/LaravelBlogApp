@extends('front.layouts.master')
@section('title','Anasayfa')
@section('content')
      <div class="col-lg-9 col-md-10 mx-auto">
        @include('front.widgets.articleListWidget')
      </div>
      @include('front.widgets.categoryWidget')
@endsection