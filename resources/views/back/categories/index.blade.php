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
                                    <th>Toplam Yazı</th>
                                    <th>Aktif Yazı</th>
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
                                <td>{{$category->getArticleCount()}}</td>
                                <td>{{$category->getActiveArticleCount()}}</td>
                                <td>
                                    <input data-id="{{$category->id}}" class="toggle-event" type="checkbox" @if($category->status==1) checked @endif data-toggle="toggle" data-width="100" data-onstyle="success" data-offstyle="danger"  data-on="Aktif" data-off="Pasif">
                                </td>
                                <td width="150">
                                        <a href="{{route('category',[$category->slug])}}" target="_blank" title="Görüntüle" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                        <button data-toggle="modal" data-target="#exampleModal" data-id="{{$category->id}}" type="button" title="Düzenle" class="btn btn-sm btn-warning btn-data">
                                            <i class="fa fa-pen" aria-hidden="true"></i>
                                        </button>
                                        <a title="Geri Dönüşüme Gönder" class="btn btn-sm btn-danger delete-modal" data-id="{{$category->id}}" data-count="{{$category->getArticleCount()}}">
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
        </div>
    </div>   

      {{-- modals --}}
      {{-- düzenle modals --}}
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Kategori Güncelle</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('admin.kategoriler.update')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category">Kategori Adı</label>
                        <input type="text" class="form-control" required name="category" id="category">
                        <input type="hidden" name="category_id" id="updateId">
                    </div>
                    <div class="form-group">
                        <label for="category">Kategori Slug</label>
                        <input type="text" class="form-control" required name="slug" id="slug">
                    </div>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-success">Kaydet</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                </div>
            </form>
          </div>
        </div>
      </div>
      {{-- sil modals --}}
      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Kategori Sil</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('admin.kategoriler.delete')}}" method="POST">
                @csrf
                <div class="modal-body">  
                    <div class="alert alert-danger">                        
                        <p class="lead">Kategoriye silmek istediğinize emin misiniz ? <br> (Bu işlem geri alınamaz!)</p>   
                        <div id="alertMessage"><strong>Önemli</strong> : Kategoriye ait makaleler bulunmaktadır, silinmesi durumunda bu makaleler taşınacaktır.</div>                    
                    </div>                  
                    <input type="hidden" name="category_id" id="deleteId">
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-success">Kategoriyi Sil</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                </div>
            </form>
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
        $('.delete-modal').click(function(){
            id = $(this)[0].getAttribute('data-id');
            count = $(this)[0].getAttribute('data-count');
            $('#deleteId').val(id);
            $('#alertMessage').hide();
            if(count > 0){
                $('#alertMessage').show();
            }
            $('#deleteModal').modal();           
        });

        $('.btn-data').click(function (e) { 
            id = $(this)[0].getAttribute('data-id');
            $('#updateId').val(id);
            $.ajax({
                type: "get",
                url: "{{route('admin.kategoriler.getdata')}}",
                data: {id:id},
                success: function (response) {
                    $('#category').val(response.name);
                    $('#slug').val(response.slug);
                }
            });

        
        });

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