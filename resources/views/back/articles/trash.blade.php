@extends('back.layouts.master')
@section('title','Silinmiş Makaleler')
@section('content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">@yield('title')
        <p>{{count($articles)}} Makale Bulundu</p>
        </h6>
        <h6 class="m-0 font-weight-bold text-primary float-right">
            <a href="{{route('admin.makaleler.index')}}" class="btn btn-primary">Aktif Gönderiler</a> 
        </h6>
        <div class="clearfix"></div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Fotoğraf</th>                        
                        <th>Başlık</th>
                        <th>Kategori</th>
                        <th>Hit</th>
                        <th>Silinme Zamanı</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>                
                <tbody>                    
                   @if(count($articles) == 0)
                    <tr>                      
                        <td colspan="7">
                            <div class="alert alert-danger">Veri Bulunamadı</div>
                        </td>
                    </tr>
                       @else
                       @foreach($articles as $article)
                   <tr>
                    <td>
                        <img src="{{ asset($article->image) }}" alt="{{$article->title}}" width="200">
                    </td>
                    <td>{{$article->title}}</td>
                    <td>{{$article->getCategory->name}}</td>
                    <td>{{$article->hit}}</td>
                    <td>{{$article->deleted_at->diffForHumans()}}</td>                    
                    <td width="150">                           
                            <a href="{{route('admin.article.recovery',$article->id)}}" title="Geri Yükle" class="btn btn-sm btn-primary">
                                <i class="fa fa-recycle" aria-hidden="true"></i>
                            </a>
                            <a href="{{route('admin.article.hardDelete',$article->id)}}" title="Kalıcı Olarak Sil" class="btn btn-sm btn-danger">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </a>
                    </td>
                    </tr>
                    @endforeach
                   @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('css')    
<link href="{{asset('back')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

@endsection
@section('js')    
 <!-- Page level plugins -->
 <script src="{{asset('back')}}/vendor/datatables/jquery.dataTables.min.js"></script>
 <script src="{{asset('back')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

 <!-- Page level custom scripts -->
 <script src="{{asset('back')}}/js/demo/datatables-demo.js"></script>
 <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
 <script>
    $(function() {
      $('.toggle-event').change(function() {
        statu = $(this).prop('checked');
        id = $(this)[0].getAttribute('data-id');
        $.get("{{route('admin.switch')}}", {statu:statu,id:id},
            function (data, textStatus, jqXHR) {
               
            }
        );
      })
    })
  </script>
@endsection