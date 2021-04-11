@if(count($articles) > 0)
@foreach($articles as $article) 
<div class="post-preview">
  <img class="card-img" src="{{$article->image}}" alt="Article image {{$article->id}}">
  <a href="{{route('single',[$article->getCategory->slug,$article->slug])}}">
    <h3 class="post-title">
     {{$article->title}}
    </h3>    
    <h4 class="post-subtitle">
      {!! Str::limit($article->content,500) !!}      
    </h4>
  </a>
  <p class="post-meta">
    @isset($category)    
      Catagory is : <a href="{{route('category',$category->slug)}}">{{$article->getCategory->name}}</a> 
    @endisset         
    <span class="float-right">{{$article->created_at->diffForHumans()}} paylaşıldı.</span>  
    <br> 
  </p>  
</div>
  @if(!$loop->last)
    <hr>
  @endif
@endforeach
<div style="margin-top: 80px !important; display: flex; justify-content: flex-start">
  {{$articles->links()}}
</div>
@else       
<div class="alert alert-danger text-center">Yazı Bulunamadı.</div>
@endif