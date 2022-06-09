@extends('layouts.master')
@section('content')
    <div class="container-fluid mt-0">
        <div class="row">
            <div class="col-4">
                <div class="card mt-5 ml-5 card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                 src="{{asset('storage/profile/'.$user->profile)}}"
                                 alt="User profile picture">
                        </div>
                        <p class="text-muted mt-3 text-center">{{$user->role}}</p>

                        <form action="{{ route("profile.update",$user->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group" >
                                <label for="profile" class="mt-3">Choose  New Photo</label>
                                <input type="file" name="profile" value="{{old('profile',$user->profile)}}" class="form-control p-1" accept="image/jpeg,image/png">
                                @error("profile")
                                <small class="font-weight-bold text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Name</b> <a class="float-right">{{$user->name}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right">{{$user->email}}</a>
                                </li>
                            </ul>
                            <button type="submit" class="btn btn-primary w-100">
                                UPDATE
                            </button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection

