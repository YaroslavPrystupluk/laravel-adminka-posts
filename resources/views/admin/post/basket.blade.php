@extends('admin.layouts.default')
@section('title', 'Basket')
@section('content')

    <div class="col-sm-6">
        <h3 class="mb-0">Basket</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.main.index') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('posts.index') }}">Posts</a></li>
            <li class="breadcrumb-item active" aria-current="page"><strong>Basket</strong></li>
        </ol>
    </div>

    <div class="app-content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <a class="btn btn-primary" href="{{ route('posts.index') }}">Back to posts</a>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered" role="table">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 40px;">
                                            <input class="form-check-input" type="checkbox" id="selectAll">
                                        </th>
                                        <th style="width: 10px" scope="col">Id</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Views</th>
                                        <th scope="col">Deleted</th>
                                        <th style="width: 150px" scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr class="align-middle">
                                            <td style="width: 40px;">
                                                <input name="ids[]" class="form-check-input row-checkbox" type="checkbox"
                                                    value="{{ $post->id }}">
                                            </td>
                                            <td>{{ $post->id }}</td>
                                            <td><img src="/{{ $post->thumb ?: env('NO_IMAGE', 'no-image.png') }}"
                                                    alt="logo post" height="40" /></td>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->category->title }}</td>
                                            <td>{{ $post->views }}</td>
                                            <td>{{ $post->deleted_at }}</td>
                                            <td class="d-flex gap-2">
                                                <a class="btn btn-info"
                                                    href="{{ route('admin.posts.basket.restore', ['post' => $post->id]) }}"><i
                                                        class="bi bi-recycle"></i></a>
                                                <form method="POST"
                                                    action="{{ route('admin.posts.basket.destroy', ['post' => $post->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger"
                                                        onclick="return confirm('Confirm delete')"><i
                                                            class="bi bi-trash"></i></button>
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
