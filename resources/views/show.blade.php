@extends('includes.app')
@section('title')
    Show Page
@endsection
@section('content')
  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light"> Album Name : {{$album->name}}</h1>
      </div>
    </div>
  </section>
 <div class="album py-5 bg-body-tertiary">
    <div class="container">

      <div class="row  d-flex  justify-content-center">
{{-- @dd() --}}
@if (count($album->getMedia('document')) > 0)

        @foreach ($album->getMedia('document') as $index=> $item)
        {{-- @dd($item) --}}
        <div class="card text-bg-dark  col-3 m-2">
          <input type="hidden" id="file-name" value="{{$item->file_name}}">
          <img src="{{$item->getFullUrl()}}" alt="Snow" class="card-img" >
          <div class="card-img-overlay">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick='GFG_Fun("{{$item->file_name}}","{{$item->id}}","{{$album->id}}")'>Delete</button>

          </div>
        </div>
        @endforeach
        @else
         no Photo in this Album 
         @endif 




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="model-content">

  </div>
</div>


    </div>
  </div>
</div>

@endsection
@section('scripts')
    
<script type="text/javascript">
       function GFG_Fun(parameter,id,album) {
        // console.log(album);

              var html ="<div class='modal-content'><div class='modal-header'><h1 class='modal-title fs-5'  id='exampleModalLabel'>" +parameter+ "</h1><button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button></div><div class='modal-body'>Doy you want to delete image or move to anther album</div><div class='modal-footer'><button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button><a href='/album/delete/"+album+"/"+id+"' type='button' class='btn btn-danger'>Delete</a><a href='/album/show-move/"+album+"/"+id+"' type='button' class='btn  btn-warning'>Move</a></div></div>"

            document.getElementById('model-content').innerHTML= html;
        }
</script>  
@endsection