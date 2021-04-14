@extends('back.layouts.master')
@section('title','Tüm Sayfalar')
@section('content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">@yield('title')       
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div style="display: none;" class="alert alert-success text-center" id="alertMessage">Sıralama Başarıyla Güncellendi!</div>
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sıralama</th>
                        <th width="200">Resim</th>                        
                        <th>Sayfa Adı</th>
                        <th>Durum</th>
                        <th>İşlemler</th>                        
                    </tr>
                </thead>                
                <tbody id="my-list">                    
                @if(count($pages) == 0)
                    <tr>                      
                        <td colspan="4">
                            <div class="alert alert-danger">Veri Bulunamadı</div>
                        </td>
                    </tr>
                @else
                       @foreach($pages as $page)
                   <tr id="page_{{$page->id}}">
                    <td width="30" class="handle"><i class="fa fa-arrows-alt-v fa-2x" style="cursor: move;" aria-hidden="true"></i></td>
                    <td>
                        <img src="{{ asset($page->image) }}" alt="{{$page->title}}" width="200">
                    </td>
                    <td>{{$page->title}}</td>
                    <td>
                        <input data-id="{{$page->id}}" class="toggle-event" type="checkbox" @if($page->status==1) checked @endif data-toggle="toggle" data-width="100" data-onstyle="success" data-offstyle="danger"  data-on="Aktif" data-off="Pasif">
                    </td>
                    <td width="150">
                            <a href="{{route('page',$page->slug)}}" target="_blank" title="Görüntüle" class="btn btn-sm btn-info">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                            <a href="{{route('admin.sayfalar.update',$page->id)}}" title="Düzenle" class="btn btn-sm btn-warning">
                                <i class="fa fa-pen" aria-hidden="true"></i>
                            </a>
                            <a href="{{route('admin.sayfalar.delete.page',$page->id)}}" title="Kalıcı olarak sil" class="btn btn-sm btn-danger">
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
 <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.13.0/Sortable.min.js" integrity="sha512-5x7t0fTAVo9dpfbp3WtE2N6bfipUwk7siViWncdDoSz2KwOqVC1N9fDxEOzk0vTThOua/mglfF8NO7uVDLRC8Q==" crossorigin="anonymous"></script>
 <script>
     $(document).ready(function () {  
        $('#my-list').sortable({
                handle: '.handle',
                invertSwap: true,
                swap: true, // Enable swap plugin
	            swapClass: 'highlight', // The class applied to the hovered swap item
	            animation: 150,
                update:function(){
                   var orders = $('#my-list').sortable('serialize');
                   $.get("{{route('admin.sayfalar.sortpage')}}?"+orders,
                   function(data,status){
                    
                   });                   
                   $('#alertMessage').fadeIn(3000).fadeOut(1000);
                }
            });       

    


    });
 </script>
 <script>
    $(function() {
      $('.toggle-event').change(function() {
        statu = $(this).prop('checked');
        id = $(this)[0].getAttribute('data-id');
        $.get("{{route('admin.sayfalar.switch')}}", {statu:statu,id:id},
            function (data, textStatus, jqXHR) {
               
            }
        );
      })
    })
  </script>
@endsection