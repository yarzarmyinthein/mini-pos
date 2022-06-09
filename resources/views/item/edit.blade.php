@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-4">
                <div class="card mt-5">
                    <div class="card-body">
                        <form action="{{route('item.update',$item->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="preview">
                            </div>
                            <div class="form-group" >
                                <label for="photo" class="mt-3"><i data-feather="camera" class="icon"></i>Choose Photo</label>
                                <input type="file" name="photo" class="form-control p-1"  id="file1">
                                @error("photo")
                                <small class="font-weight-bold text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name" class="mt-3">Item Name</label>
                                <input type="text" name="name" value="{{old('name',$item->name)}}" class="mt-2 form-control">
                            </div>
                            @error("name")
                            <small class="d-block font-weight-bold text-danger">{{ $message }}</small>
                            @enderror

                            <div class="form-group">
                                <label for="price" class="mt-3">Price</label>
                                <input type="number" name="price" value="{{old('price',$item->price)}}" class="mt-2 form-control">
                            </div>
                            @error("price")
                            <small class="d-block font-weight-bold text-danger">{{ $message }}</small>
                            @enderror

                            <div class="form-group">
                                <label for="category" class="mt-3">Category</label>
                                <select name="category_id" class="form-select">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error("category")
                            <small class="d-block font-weight-bold text-danger">{{ $message }}</small>
                            @enderror

                            <button class="btn btn-outline-primary mt-2">Update Item</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $('#file1').on('change',function (){
            var filelength= document.getElementById('file1').files.length;
            for(let i=0;i<filelength;i++){
                $('.preview').html('');
                $('.preview').append(`<img class="w-100 rounded" src="${URL.createObjectURL(event.target.files[i])}">`);
            }
        });
    </script>
@endsection
