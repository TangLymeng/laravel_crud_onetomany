@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            @foreach($categories as $category)
                <div class="col-md-4 mt-4">
                    <a href="{{ url('/collections/'.$category->slug) }}">
                        <div class="card">
                            <div class="card-body">
                                <h4>{{ $category->name }}</h4>
                            @if(count($category->posts) > 0)
                                    <ul>
                                        @foreach($category->posts as $item)
                                            <li>{{ $item->title }} - {{ $item->description }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    No post
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

@endsection

