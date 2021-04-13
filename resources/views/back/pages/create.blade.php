@extends('back.layouts.master')
@section('title','Sayfa Oluştur')
@section('content')
    <div class="card">
        <div class="card-body">
            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </div>
            @endif
            <form action="{{route('admin.sayfalar.create.page')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Sayfa Başlığı</label>
                    <input type="text" class="form-control" id="title" name="title" required placeholder="Sayfa başlığı giriniz..">
                </div>                
                <div class="form-group">
                    <label for="title">Sayfa Fotoğrafı</label>
                    <input type="file" class="form-control" id="image" name="image" required>
                </div>
                <div class="form-group">
                    <label for="title">Sayfa İçeriği</label>                    
                    <textarea name="content" class="form-control" id="summernote" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block">Sayfa Oluştur</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('css')
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('js')
<!-- include summernote css/js -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
        placeholder: 'Sayfa içeriğini buraya giriniz..',
        tabsize: 2,
        height: 200
        });
    });
</script>
@endsection