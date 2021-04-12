@extends('back.layouts.master')
@section('title','Tüm Kategoriler')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-primary"><b>Kategori Ekle</b></div>
                <div class="card-body">
                    <form action="{{route('admin.kategoriler.create')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="category">Kategori Adı</label>
                         <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Kategori Ekle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-primary"><b>@yield('title')</b></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Kategori Adı</th>  
                                    <th>İçerdiği Yazı</th>
                                    <th>Durum</th>
                                    <th>İşlemler</th>
                                    
                                </tr>
                            </thead>                
                            <tbody>                    
                               @if(count($categories) == 0)
                                <tr>                      
                                    <td colspan="4">
                                        <div class="alert alert-danger">Veri Bulunamadı</div>
                                    </td>
                                </tr>
                                   @else
                                   @foreach($categories as $category)
                               <tr>                                
                                <td>{{$category->name}}</td>
                                <td>{{$category->getCategoryCount()}}</td>
                                <td>
                                    <input data-id="{{$category->id}}" class="toggle-event" type="checkbox" @if($category->status==1) checked @endif data-toggle="toggle" data-width="100" data-onstyle="success" data-offstyle="danger"  data-on="Aktif" data-off="Pasif">
                                </td>
                                <td width="150">
                                        <a href="{{route('category',[$category->slug])}}" target="_blank" title="Görüntüle" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                        {{-- <a href="{{route('admin.makaleler.edit',$category->id)}}" title="Düzenle" class="btn btn-sm btn-warning">
                                            <i class="fa fa-pen" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{route('admin.article.delete',$category->id)}}" title="Geri Dönüşüme Gönder" class="btn btn-sm btn-danger">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </a> --}}
                                </td>
                                </tr>
                                @endforeach
                               @endif
                            </tbody>
                        </table>
                    </div>
                </div>
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
        $.get("{{route('admin.kategoriler.switch')}}", {statu:statu,id:id},
            function (data, textStatus, jqXHR) {
               
            }
        );
      })
    })
  </script>
@endsection