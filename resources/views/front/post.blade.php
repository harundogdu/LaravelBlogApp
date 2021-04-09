@extends('front.layouts.master')
@section('title',$article->title)
@section('bg', $article->image)
@section('mainTitle',$article->title)
@section('content')
    <div class="col-lg-9 col-md-10 mx-auto">
        {!!$article->content!!}
        <p class="post-meta">
            Catagory is : <a href="#">{{$article->getCategory->name}}</a>    
            <span class="float-right">shared on {{$article->created_at->diffForHumans()}}</span>                  
          </p>
          <p class="post-met">
            <span class="text-danger">Okunma sayısı : <b>{{$article->hit}}</b></span>  
          </p>        
    </div>
    @include('front.widgets.categoryWidget')
@endsection