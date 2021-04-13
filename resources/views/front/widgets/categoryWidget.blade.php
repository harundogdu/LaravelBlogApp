@isset($categories)
<div class="col-lg-3 col-md-2">
  <div class="card">
@if(count($categories) == 0)
          <div class="card-header text-danger">Kategori Bulunamadı</div>
          @else          
            <div class="card-header">Kategoriler</div>
              <ul class="list-group">
                @foreach($categories as $category)  
                <a @if(Request::segment(2) != $category->slug)  href="{{route('category',$category->slug)}}" @endif>              
                  <li class="list-group-item d-flex justify-content-between align-items-center @if(Request::segment(2) == $category->slug) active text-light @endif">                    
                    {{$category->name}}
                    <span class="badge badge-danger badge-pill">{{$category->getActiveArticleCount()}}</span>   
                  </li>         
                </a>                    
                @endforeach                    
              </ul>
        @endif         
      </div>        
    </div>     
@endisset