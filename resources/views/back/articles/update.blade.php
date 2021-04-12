@extends('back.layouts.master')
@section('title',$article->title)
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
            <form action="{{route('admin.makaleler.update',$article->id)}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="title">Makale Başlığı</label>
                    <input type="text" class="form-control" value="{{$article->title}}" id="title" name="title" required placeholder="Makale başlığı giriniz..">
                </div>
                <div class="form-group">
                    <label for="title">Makale Kategorisi</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="0" selected disabled>Seçim Yapınız</option>
                        @foreach($categories as $category)
                            <option @if($article->category_id == $category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Makale Fotoğrafı</label>
                    <div style="display: flex; justify-content: space-around; align-items: center;">
                        <img class="img-thumbnail" src="{{asset($article->image)}}" alt="{{$article->title}}" width="400">
                        <input type="file" class="form-control w-25" id="image" name="image">
                    </div>
                </div>
                <div class="form-group">
                    <label for="title">Makale İçeriği</label>                    
                    <textarea name="content" class="form-control" id="summernote" cols="30" rows="10">{{$article->content}}</textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block">Makale Güncelle</button>
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
        placeholder: 'Makale içeriğini buraya giriniz..',
        tabsize: 2,
        height: 200
        });
    });
</script>
@endsection