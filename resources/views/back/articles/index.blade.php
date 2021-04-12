@extends('back.layouts.master')
@section('title','Tüm Makaleler')
@section('content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">@yield('title')</h6>
        <h6 class="m-0 font-weight-bold text-primary float-right">{{count($articles)}} Makale Bulundu</h6>
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
                        <th>Oluşturma Zamanı</th>
                        <th>Durum</th>
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
                    <td>{{$article->created_at->diffForHumans()}}</td>
                    <td>
                        <input data-id="{{$article->id}}" class="toggle-event" type="checkbox" @if($article->status==1) checked @endif data-toggle="toggle" data-width="100" data-onstyle="success" data-offstyle="danger"  data-on="Aktif" data-off="Pasif">
                    </td>
                    <td width="150">
                            <a href="{{route('single',[$article->getCategory->slug,$article->slug])}}" target="_blank" title="Görüntüle" class="btn btn-sm btn-info">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                            <a href="{{route('admin.makaleler.edit',$article->id)}}" title="Düzenle" class="btn btn-sm btn-warning">
                                <i class="fa fa-pen" aria-hidden="true"></i>
                            </a>
                            <a href="" title="Sil" class="btn btn-sm btn-danger">
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