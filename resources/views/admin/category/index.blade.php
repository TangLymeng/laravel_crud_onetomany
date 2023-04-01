@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                @if($message = Session::get('success'))
                    <div>
                        <script type="text/javascript">
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: '{{$message}}'
                            })
                        </script>
                    </div>
                @endif

                <div class="card mt-5">
                    <div class="card-header">
                        <h4> Category Details
                            <a href="{{ url('admin/category/create') }}" class="btn btn-primary float-end">Add Category</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <a href="{{ url('admin/category/'.$category->id.'/edit') }}" class="btn btn-primary">Edit</a>
                                        <form action="{{ url('admin/category/'.$category->id) }}" method="post" style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{url('admin/category/'.$category->id.'/delete')}}" class="btn btn-danger">Delete</a>
                                        </form>
                                    </td>
                                </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
