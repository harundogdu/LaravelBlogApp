<div class="col-lg-3 col-md-2">
    <div class="card">
        <div class="card-header">Kategoriler</div>
            <ul class="list-group">
                @foreach($categories as $category)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  {{$category->name}}
                  <span class="badge badge-primary badge-pill">{{$category->getCategoryCount()}}</span>
                </li>                      
                @endforeach                    
              </ul>
        </div>        
  </div>