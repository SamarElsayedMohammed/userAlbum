@extends('includes.app')
@section('title')
    Edit Album
@endsection
@section('content')
    <div class="container d-flex justify-content-center mt-5">

<div class="card shadow p-3 mb-5 bg-white rounded border-0" style="width: 40rem;">
   <div class="card-header p-3 mb-5 bg-white text-dark">
    <h4 class="container d-flex justify-content-center mt-5">Edit : {{$album->name}}</h4>
   </div>
    
    
  <div class="card-body">

    <x-form route="{{route('album.update',$album)}}" name="{{$album->name}}" />
  </div>
</div>
</div>

@endsection