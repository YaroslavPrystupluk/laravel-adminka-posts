@extends('admin.layouts.default')
@section('title', 'Edit Category')
@section('content')

    <div class="col-sm-6">
        <h3 class="mb-0">Edit category</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href={{ route('adnin.main.index') }}>Home</a></li>
            <li class="breadcrumb-item " aria-current="page"><a href={{ route('categories.index') }}>Categories</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit category</strong></li>
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
                    <div class="card card-warning card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Edit category: <strong>{{ $category->title }}</div>
                        </div>
                        <form method="POST" action="{{ route('categories.update', ['category' => $category->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="title" class="form-control" id="title"
                                            value="{{ $category->title }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="meta_desc" class="col-sm-2 col-form-label">Meta description</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="meta_desc" class="form-control" id="meta_desc"
                                            value="{{ $category->meta_desc }}">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <a class="btn float-end btn-warning" href="{{ route('categories.index') }}">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!--end::Small Box Widget 4-->
    </div>
@endsection
