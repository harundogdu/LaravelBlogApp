@extends('back.layouts.master')
@section('title','Site Ayaları')
@section('content')
    <div class="row">
       <div class="col-md-12">
        <div class="card">
            <div class="card-header text-primary font-weight-bold">@yield('title')</div>
            <div class="card-body">
                <form action="{{route('admin.config.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Site Adı</label>
                                <input type="text" class="form-control" name="title" required value="{{$config->title}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Site Aktiflik</label>
                                <select name="active" id="" class="form-control" required>
                                    <option @if($config->active == 1) selected @endif value="1">Aktif</option>
                                    <option  @if($config->active == 0) selected @endif value="0">Pasif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Site Logo</label>
                                <input type="file" class="form-control" name="logo">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Site Favicon</label>
                                <input type="file" class="form-control" name="favicon">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Facebook</label>
                               <input type="text" class="form-control" name="facebook" value="{{$config->facebook}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">İnstagram</label>
                                <input type="text" class="form-control" name="instagram" value="{{$config->instagram}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Linkedin</label>
                               <input type="text" class="form-control" name="linkedin" value="{{$config->linkedin}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Youtube</label>
                                <input type="text" class="form-control" name="youtube" value="{{$config->youtube}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Github</label>
                               <input type="text" class="form-control" name="github" value="{{$config->github}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Twitter</label>
                                <input type="text" class="form-control" name="twitter" value="{{$config->twitter}}">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="">Yapımcı Hakkında</label>
                            <textarea name="aboutOfCreator" id="" cols="30" rows="10" class="form-control">{{$config->aboutOfCreator}}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-lg btn-primary btn-block">Site Ayarlarını Güncelle</button>
                        </div>
                    </div>                    
                </form>
            </div>
        </div>
       </div>
    </div>
@endsection