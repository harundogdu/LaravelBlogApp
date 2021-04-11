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
                   @foreach($articles as $article)
                   <tr>
                    <td><img src="{{$article->image}}" alt="{{$article->title}}" width="200"></td>
                    <td>{{$article->title}}</td>
                    <td>{{$article->getCategory->name}}</td>
                    <td>{{$article->hit}}</td>
                    <td>{{$article->created_at->diffForHumans()}}</td>
                    <td>
                        @if($article->status==0)<span class="text-danger"><strong>Pasif</strong></span>
                        @else<span class="text-success"><strong>Aktif</strong></span>
                        @endif
                    </td>
                    <td width="150">
                            <a href="{{route('single',[$article->getCategory->slug,$article->slug])}}" target="_blank" title="Görüntüle" class="btn btn-sm btn-info">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                            <a href="" title="Düzenle" class="btn btn-sm btn-warning">
                                <i class="fa fa-pen" aria-hidden="true"></i>
                            </a>
                            <a href="" title="Sil" class="btn btn-sm btn-danger">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </a>
                    </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection