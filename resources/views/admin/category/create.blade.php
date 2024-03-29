@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4> Add Category
                            <a href="{{url ('admin/category')}}" class="btn btn-primary float-end">Back</a>
                        </h4>

                    </div>
                    <div class="card-body">
                        <form action="{{url('admin/category')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label>Category Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
