@extends('admin.layouts.default')
@section('title', 'Posts')
@section('content')

    <div class="col-sm-6">
        <h3 class="mb-0">Posts</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('adnin.main.index') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Posts</li>
        </ol>
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <a class="btn btn-primary" href="{{ route('posts.create') }}">Create post</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered" role="table">
                                <thead>
                                    <tr>
                                        <th style="width: 10px" scope="col">Id</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Category</th>
                                        <th style="width: 150px" scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr class="align-middle">
                                            <td>{{ $post->id }}</td>
                                            <td>{{ $post->thumb }}</td>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->category->title }}</td>
                                            <td>{{ $post->views }}</td>
                                            <td class="d-flex gap-2">
                                                <a class="btn btn-warning" href="{{ route('posts.edit', ['post' => $post->id]) }}"
                                                    ><i class="bi bi-pencil"></i></a>
                                                <form method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                <button class="btn btn-danger" onclick="return confirm('Confirm delete')"><i class="bi bi-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $posts->links('vendor.pagination.bootstrap-5-admin') }}

                        </div>
                    </div>
                </div>
            </div>
            <!--end::Small Box Widget 4-->
        </div>
    @endsection
