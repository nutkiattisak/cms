@extends('layouts.app')

@section('content')
<div class="card card-tasks">
    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
        <div class="card-header">
        <h4 class="card-title">{{ $chkTrashed == true ? 'Trash Post' : 'Post'}}</h4>
        </div>
        <div class="btn-group mt-2 mr-2" role="group" aria-label="First group">
            <a href="{{ route('posts.create')}}" class="btn btn-md btn-info">Add</a>
            
            <a href="{{route('trashed-posts.index')}}" class="btn btn-md btn-danger">Trask</a>
            
          </div>
        </div>
        <div class="card-body">
        @if($posts->count() > 0)
        <div class="table-responsive ps">
            <table class="table tablesorter ">
                <thead class="text-primary">
                    <tr>
                        <th width="200px">Image</th>
                        <th>Titile</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <td>
                            <img src="{{ asset("storage/".$post->image) }}" width="120px" alt="">
                        </td>
                        <td width="300px">{{ $post->title}}</td>
                        <td class="td-actions text-right">
                            @if(!$post->trashed())
                            <div class="btn-group mr-2" role="group" aria-label="Second group">
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-link">
                                    <i class="tim-icons icon-pencil"></i>
                                </a>
                            </div>
                            @else
                            <div class="btn-group mr-2" role="group" aria-label="Second group">
                                
                                <form action="{{ route('restore-posts', $post->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-link">
                                    <i class="tim-icons icon-refresh-02"></i>
                                    </button>
                                </form>
                                
                            </div>
                            @endif
                            <div class="btn-group" role="group" aria-label="Third group">
                                <form action="{{route('posts.destroy', $post->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link">
                                        <i class="tim-icons icon-trash-simple"></i>
                                    </button>
                                    
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
            <h3 class="text-center">No Posts</h3>
        @endif
    </div>
</div>
@endsection