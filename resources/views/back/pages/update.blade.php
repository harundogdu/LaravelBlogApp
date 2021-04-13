@extends('back.layouts.master')
@section('title',$page->title)
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
            <form action="{{route('admin.sayfalar.update.page',$page->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Sayfa Başlığı</label>
                    <input type="text" class="form-control" value="{{$page->title}}" id="title" name="title" required placeholder="Sayfa başlığı giriniz..">
                </div>               
                <div class="form-group">
                    <label for="title">Sayfa Fotoğrafı</label>
                    <div style="display: flex; justify-content: space-around; align-items: center;">
                        <img class="img-thumbnail" src="{{asset($page->image)}}" alt="{{$page->title}}" width="400">
                        <input type="file" class="form-control w-25" id="image" name="image">
                    </div>
                </div>
                <div class="form-group">
                    <label for="title">Sayfa İçeriği</label>                    
                    <textarea name="content" class="form-control" id="summernote" cols="30" rows="10">{{$page->content}}</textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block">Sayfa Güncelle</button>
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