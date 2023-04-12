@extends('includes.app')
@section('title')
    Move To anther Album
@endsection
@section('content')
    <div class="container d-flex justify-content-center mt-5 col-7">
 @if(isset($mediaItem)) 
<div class="card shadow p-3 mb-5 bg-white rounded border-0" style="width: 50rem;">
   
    <h4 class="container d-flex justify-content-center mt-5">Move Image To : </h4>
 {{-- @dd($mediaItem) --}}
  <div class="card-body">
    
   <form action="{{route('album.move')}}" method="POST" enctype="multipart/form-data">
    @csrf
   
    <div class="mb-3 form-group d-flex justify-content-center border-0">
        <img style="height: 250px;width:300px;" src="{{$mediaItem->getFullUrl()}}" class="form-control border-0" alt="">
    </div> 
    
    {{-- Name/Description fields, irrelevant for this article --}}
<input type="hidden" name="model_id" value="{{$mediaItem->model_id}}">
<input type="hidden" name="image_id" value="{{$mediaItem->id}}">
    <div class="form-group d-flex justify-content-center">
<select name="album_move" class="form-select" aria-label="Default select example">
    @foreach ($names as $key =>$name)
    @if ($key != $mediaItem->model_id)
       <option value="{{$key}}">{{$name}}</option>
    @endif
        
    @endforeach
   
</select>
        </div>

    </div>
             @error('document')
        <span class="text-danger">{{$message}}</span>
      @enderror
    <div class="form-group d-flex justify-content-center" >
        <input class="btn btn-danger col-2 m-2" type="submit">
    </div>
</form>
</div>
</div>
@else
<div class="card shadow p-3 mb-5 bg-white rounded border-0" style="width: 50rem;">
        <h4 class="container d-flex justify-content-center mt-5 mb-5">image not found </h4>
  </div>
 @endif
 
</div>

@endsection