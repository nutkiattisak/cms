@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h4 class="card-title">
            {{ isset($post) ? 'Edit Post' : 'Create Post'}}</h4>
        </div>
        <div class="card-body">
            @if($errors->any())
            <div class="alert alert-danger">
                <ul class="list-group">
                    @foreach ($errors->all() as $error)
                        <li class="list-group-item">
                            {{$error}}
                        </li>
                    @endforeach
                </ul>
            </div>
            @endif
        <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($post))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{isset($post) ? $post->title : ''}}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" cols="5" rows="5">{{ isset($post) ? $post->description : ''}}</textarea>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <input id="content" type="hidden" name="content" value="{{isset($post) ? $post->content : ''}}">
                    <trix-editor input="content"></trix-editor>
                </div>
                <div class="form-group">
                    <label for="published_at">Published At</label>
                    <input type="text" name="published_at" id="published_at" class="form-control" value="{{isset($post) ? $post->published_at : ''}}">
                </div>
                @if(isset($post))
                <div class="form-group">
                    <img src="{{ asset("storage/".$post->image) }}" alt="" style="width:120px;">
                </div>
                @endif
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control">
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}" 
                            @if(isset($post))
                            @if($post->category_id == $category->id)
                                selected
                            @endif
                            @endif
                            >
                            {{ $category->name }}</option>
                        @endforeach
                        
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <div class="form-group">
                <button type="submit" class="btn btn-success">{{ isset($post) ? 'Update Post' : 'Create Post'}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
    <script>
        flatpickr("#published_at",{
            enableTime: true,
            disableMobile: "true"
        });
    </script>
    
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_red.css">

@endsection