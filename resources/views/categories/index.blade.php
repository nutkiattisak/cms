@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-2">
    <a href="{{ route('categories.create')}}" class="btn btn-success">Add Category</a>
</div>
<div class="card card-default">
    <div class="card-header">Categories</div>
    <div class="card-body">
      @if($categories->count() > 0)
        <table class="table">
            <thead>
                <th>Name</th>
                <th>Post Count</th>
                <th>#</th>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>
                        {{$category->name}}
                    </td>
                    <td>
                        {{$category->post-count()}}
                    </td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id)}}" class="btn btn-warning">Edit</a>
                        <a class="btn btn-danger" data-toggle="modal" onclick="handleDelete({{$category->id}})">Del</a>
                    </td>
                </tr>
                
                @endforeach
            </tbody>
        </table>
        <div class="modal" id="deleteModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" id="deleteModal" role="document">
                <form action="" method="POST" id="deleteCategoryForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title">Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        <p>Are you sure you want to delete this category?</p>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      @else
        <h3 class="text-center">No Category Yet!</h3>
      @endif
    </div>
</div>
@endsection

@section('script')
<script>
    function handleDelete(id){
        let form = document.getElementById('deleteCategoryForm')
        form.action = '/categories/' + id
        $('#deleteModal').modal('show')

    }
</script>
@endsection