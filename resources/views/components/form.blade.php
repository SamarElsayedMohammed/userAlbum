   <form action="{{$route}}" method="POST" enctype="multipart/form-data">
    @csrf

<div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1">Name</span>
  <input type="text" class="form-control" placeholder="Album Name" name="name" value="{{ old('name',$name) }}" aria-label="Album Name" aria-describedby="basic-addon1" required>
@error('name')
        <span class="text-danger">{{$message}}</span>
      @enderror
</div>
    <div class="form-group d-flex justify-content-center">
        <div class="needsclick dropzone " id="document-dropzone">
<i style="color:rgb(215, 214, 216);font-size:150px" class="fa-solid fa-cloud-arrow-up"></i>
        </div>

    </div>
             @error('document')
        <span class="text-danger">{{$message}}</span>
      @enderror
    <div class="d-flex justify-content-center">
        <input class="btn btn-danger" type="submit">
    </div>
</form>