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
                            <a class="btn btn-primary mb-3" href="{{ route('posts.index') }}">
                                <i class="bi bi-arrow-left"></i> Back to posts
                            </a>

                            <form id="actionsAllForm" method="POST" action="">
                                @csrf
                                <input type="hidden" name="_method" id="formMethod" value="POST">

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-info"
                                        onclick="return submitBulk('{{ route('admin.posts.basket.restore-all') }}', 'POST', null)">
                                        <i class="bi bi-recycle"></i> Restore selected
                                    </button>

                                    <button type="submit" class="btn btn-danger"
                                        onclick="return submitBulk('{{ route('admin.posts.basket.destroy-all') }}', 'DELETE', 'Confirm delete')">
                                        <i class="bi bi-trash"></i> Delete selected
                                    </button>
                                </div>
                            </form>
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
                                                <input form="actionsAllForm" name="ids[]"
                                                    class="form-check-input row-checkbox" type="checkbox"
                                                    value="{{ $post->id }}">
                                            </td>
                                            <td>{{ $post->id }}</td>
                                            <td>
                                                <img src="/{{ $post->thumb ?: env('NO_IMAGE', 'no-image.png') }}"
                                                    alt="logo post" height="40" />
                                            </td>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->category->title }}</td>
                                            <td>{{ $post->views }}</td>
                                            <td>{{ $post->deleted_at }}</td>
                                            <td class="d-flex gap-2">
                                                <a class="btn btn-info"
                                                    href="{{ route('admin.posts.basket.restore', ['post' => $post->id]) }}">
                                                    <i class="bi bi-recycle"></i>
                                                </a>
                                                <form method="POST"
                                                    action="{{ route('admin.posts.basket.destroy', ['post' => $post->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger"
                                                        onclick="return confirm('Confirm delete')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer clearfix">
                            {{ $posts->links('vendor.pagination.bootstrap-5-admin') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function submitBulk(action, method, confirmMsg) {
                if (confirmMsg && !confirm(confirmMsg)) return false;

                const form = document.getElementById('actionsAllForm');
                form.action = action;
                document.getElementById('formMethod').value = method;

                return true;
            }

            const selectAll = document.getElementById('selectAll');
            const rowCheckboxes = document.querySelectorAll('.row-checkbox');

            selectAll.addEventListener('change', function() {
                rowCheckboxes.forEach(cb => cb.checked = this.checked);
            });

            rowCheckboxes.forEach(cb => {
                cb.addEventListener('change', function() {
                    selectAll.checked = Array.from(rowCheckboxes).every(c => c.checked);
                });
            });
        </script>
    @endsection
