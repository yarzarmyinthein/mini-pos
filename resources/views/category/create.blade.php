@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card mt-5">
                    <div class="card-header">
                        Category Create
                    </div>
                    <div class="card-body">
                        <form action="{{route('category.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="">Category Name</label>
                                <input type="text" name="name" value="{{old('name')}}" class=" form-control">
                            </div>
                            @error("name")
                            <small class="d-block font-weight-bold text-danger">{{ $message }}</small>
                            @enderror
                            <button class="btn btn-outline-primary mt-2">Add Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

