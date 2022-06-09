@extends('layouts.master')
@section('header')
    <link rel="stylesheet" href="{{asset('dashboard/dist/css/table.css')}}">
    <style>
        .card-header:after{
            display: none!important;
        }
    </style>
@endsection
@section('content')
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <body>
    <div class="main-content">
        <div class="container mt-5">
            <!-- Table -->

                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0 d-flex justify-content-between">
                            <h3 class="mb-0">Category List</h3>
                            <a href="{{route('category.create')}}" class="btn btn-sm btn-outline-info">
                                CREATE
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">Category</th>
                                    <th scope="col">Uploader</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>
                                            {{$category->name}}
                                        </td>
                                        <td>
                                            <div class="avatar-group">
                                                {{$category->user->name}}
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item btn btn-sm btn-outline-warning" href="{{route('category.edit',$category->id)}}">Edit</a>
                                                    <form action="{{ route('category.destroy', $category->id) }}" method="post" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="dropdown-item btn btn-sm btn-outline-danger" onclick="return confirm('Are You Sure To Delete?')">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer py-4">
                            <nav aria-label="...">
                                <ul class="pagination justify-content-end mb-0">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1">
                                            <i class="fas fa-angle-left"></i>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">
                                            <i class="fas fa-angle-right"></i>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>

@endsection
