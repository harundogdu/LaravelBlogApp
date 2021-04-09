@extends('front.layouts.master')
@section('title','Anasayfa')
@section('content')
      <div class="col-lg-9 col-md-10 mx-auto">
        @foreach($articles as $article)
        <div class="post-preview">
          <a href="post.html">
            <h2 class="post-title">
             {{$article->title}}
            </h2>
            <h3 class="post-subtitle">
              {{str_limit($article->content,75)}}
            </h3>
          </a>
          <p class="post-meta">
            Catagory is : <a href="#">{{$article->getCategory->name}}</a>    
            <span class="float-right">shared on {{$article->created_at->diffForHumans()}}</span>                  
          </p>        
        </div>
          @if(!$loop->last)
            <hr>
          @endif
        @endforeach
      </div>
      @include('front.widgets.categoryWidget')
@endsection