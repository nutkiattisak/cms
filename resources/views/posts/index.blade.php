@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-2">
    <a href="{{ route('posts.create')}}" class="btn btn-success">Add Post</a>
</div>
<div class="card card-default">
    <div class="card-header">Posts</div>
    <div class="card-body">
        @if($posts->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Titile</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>
                        <img src="{{ asset("storage/".$post->image) }}" width="120px" alt="">
                    </td>
                    <td>{{ $post->title}}</td>
                    <td>
                        @if(!$post->trashed())
                        <div class="btn-group mr-2" role="group" aria-label="Second group">
                            <a href="" class="btn btn-warning btn-sm">Edit</a>
                        </div>
                        @endif
                        <div class="btn-group" role="group" aria-label="Third group">
                            <form action="{{route('posts.destroy', $post->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    {{ $post->trashed() ? 'Delete' : 'Trash' }}
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
        @else
            <h3 class="text-center">No Posts</h3>
        @endif
    </div>
</div>
@endsection