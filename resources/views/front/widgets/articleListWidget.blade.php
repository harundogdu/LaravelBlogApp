@if(count($articles) > 0)
@foreach($articles as $article) 
<div class="post-preview">
  <img src="{{$article->image}}" alt="Article image {{$article->id}}">
  <a href="{{route('single',[$article->getCategory->slug,$article->slug])}}">
    <h3 class="post-title">
     {{$article->title}}
    </h3>
    <h4 class="post-subtitle">
      {{str_limit($article->content,75)}}
    </h4>
  </a>
  <p class="post-meta">
    @isset($category)    
      Catagory is : <a href="{{route('category',$category->slug)}}">{{$article->getCategory->name}}</a> 
    @endisset         
    <span class="float-right">shared on {{$article->created_at->diffForHumans()}}</span>   
  </p>  
</div>
  @if(!$loop->last)
    <hr>
  @endif
@endforeach
<div style="margin-top: 100px !important; display: flex; justify-content: flex-end">
  {{$articles->links()}}
</div>
@else       
<div class="alert alert-danger text-center">Yazı Bulunamadı.</div>
@endif