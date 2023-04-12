@extends('includes.app')
@section('title')
  Home Page  
@endsection
@section('content')
  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Album example</h1>
        <p class="lead text-body-secondary">Upload your favorite Images to make your memories gallry</p>
        <p>
          <a href="{{route('album.create')}}" class="btn btn-primary my-2">Create New Album</a>
        </p>
      </div>
    </div>
  </section>

  <div class="album py-5 bg-body-tertiary">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3  d-flex  justify-content-center">
        @if (isset($albums) && count($albums) > 0)
        @foreach ($albums as $item)
        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" height="200" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">{{ $item->name}}</text></svg>
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="{{route('album.edit',$item->id)}}"  class="btn btn-sm  btn-warning">Edit</a>
                  <a href="{{route('album.show',$item)}}"  class="btn btn-sm btn-info">View</a>
                  @php
                      $parameter =str_replace(' ','-',$item->name);
                  @endphp
                    <button type="button" class="btn btn-sm  btn-danger"  data-bs-toggle="modal" data-bs-target="#exampleModal" onclick='GFG_Fun("{{$parameter}}","{{$item->id}}","1")'>
                    Delete
                  </button>
                 </div>
                <small class="text-body-secondary">{{$item->created_at->diffForHumans()}}</small>
              </div>
            </div>
          </div>
        </div>
        @endforeach
          @else
      no albums now
      @endif
      </div>
    </div>
  </div>

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

            var html ="<div class='modal-content'><div class='modal-header'><h1 class='modal-title fs-5'  id='exampleModalLabel'>" +parameter+ "</h1><button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button></div><div class='modal-body'>Doy you want to delete image or move to anther album</div><div class='modal-footer'><button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button><a href='/gallary/delete/"+id+" type='button' class='btn btn-danger'>Delete</a><a  onclick=MoveAlbum('"+parameter+"','"+id+"') type='button' class='btn  btn-warning'>Move</a></div></div>";
            document.getElementById('model-content').innerHTML= html;
        }

        function MoveAlbum(parameter,id){

            var page_data =  {!! json_encode($alums_names) !!};
            var token = "{{ Session::token() }}";
            var html ="<form action='/album/move-all' method='POST' enctype='multipart/form-data'><div class='modal-content'><div class='modal-header'><h1 class='modal-title fs-5'  id='exampleModalLabel'>" +parameter+ "</h1><button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button></div><div class='modal-body'><input type='hidden' name='id' value='" +id+"'><input type='hidden' name='_token' id='csrf-token' value='"+token+"' /><div class='form-group d-flex justify-content-center'><select name='model_id' class='form-select' aria-label='Default select example'>";

            let keys = Object.keys(page_data);

            keys.forEach((key) => {

              if (id != key ) {
                      html +="<option value='"+key +"'>"+page_data[key]+"</option>";
                              }    
            });
            html+= "</select></div></div><div class='modal-footer'><button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button><input type='submit' class='btn  btn-warning' value='submit'></div></div></form>"
            document.getElementById('model-content').innerHTML= html;
        }
</script>
@endsection