@extends('front.layouts.master')
@section('title','İletişim')
@section('mainTitle','İletişim Sayfası')
@section('bg','https://images.squarespace-cdn.com/content/v1/54681b9de4b01b5f0d0ebafb/1416126155014-PV178ZNJV28C418YG89T/ke17ZwdGBToddI8pDm48kKAwwdAfKsTlKsCcElEApLR7gQa3H78H3Y0txjaiv_0fDoOvxcdMmMKkDsyUqMSsMWxHk725yiiHCCLfrh8O1z5QPOohDIaIeljMHgDF5CVlOqpeNLcJ80NK65_fV7S1UegTYNQkRo-Jk4EWsyBNhwKrKLo5CceA1-Tdpfgyxoog5ck0MD3_q0rY3jFJjjoLbQ/contact-bg.jpg?format=1500w')
@section('content')
    <div class="col-md-8">
      <p class="lead">Bizimle İletişime Geçin</p>
      <hr>
      @if(session('success'))
        <div class="alert alert-success text-center">{{session('success')}}</div>
      @endif
      @if($errors->any())
      <div class="alert alert-danger text-center">
        <ul class="list-group">
          @foreach($errors->all() as $error)
            <li class="list-group-item">{{$error}}</li>
          @endforeach
        </ul>
      </div>
    @endif
        <form action="{{route('contact.post')}}" method="POST">
          @csrf          
            <div class="control-group">
              <div class="form-group ">
                <label>Adınız ve Soyadınız</label>
                <input type="text" value="{{old('name')}}" class="form-control" placeholder="Adınız ve Soyadınız" name="name" required>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group">
                <label>Email Adresiniz</label>
                <input type="email" class="form-control" value="{{old('email')}}" placeholder="Email Adresiniz" name="email" required>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group">
                <label>Telefon Numaranız</label>
                <input type="tel" class="form-control" value="{{old('phone')}}" placeholder="Telefon Numaranız" name="phone" required>
              </div>
            </div>
            <div class="control-group">
                <div class="form-group">
                  <label>Konu</label>
                  <select name="topic" class="form-control">
                      <option @if(old('topic') == 'bilgi') selected @endif value="bilgi">Bilgi</option>
                      <option @if(old('topic') == 'destek') selected @endif value="destek">Destek</option>
                      <option @if(old('topic') == 'diger') selected @endif value="diger">Diğer</option>
                  </select>
                </div>
              </div>
            <div class="control-group">
              <div class="form-group">
                <label>Mesajınız</label>
                <textarea rows="5" class="form-control" placeholder="Mesajınız" name="message" required>{{old('message')}}</textarea>
              </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Gönder</button>
          </form>
    </div>
    <div class="col-md-4">
        <div class="card mt-4">
            <div class="card-body text-center">
                <i class="text-info fas fa-home fa-2x"></i>  
                <p style="margin: 10px 0 !important;">Lokasyon</p>            
                <h6 class="lead">                 
                   Deneme mahallesi 30907.cadde No:51/20 <br> Of / TRABZON
                </h6>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body text-center">
                <i class="text-info fas fa-phone fa-2x"></i>  
                <p style="margin: 10px 0 !important;">Numaralar</p>            
                <h5 class="lead">                 
                   Tel : 0545 XXX XX XX <br>
                   Fax : 0545 XXX XX XX
                </h5>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body text-center">
                <i class="text-info fas fa-envelope fa-2x"></i>  
                <p style="margin: 10px 0 !important;">Mail</p>            
                <h5 class="lead">                 
                   harundogdu06@gmail.com
                </h5>
            </div>
        </div>
    </div>
@endsection