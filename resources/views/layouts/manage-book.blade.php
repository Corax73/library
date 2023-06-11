@extends('admin-forms')

@section('form')
<div class="container">
    <form method="post" action="{{ route('bookUpdate', $book->id) }}" enctype="multipart/form-data">
        @csrf
        @method ('patch')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="title" value="{{ $book->title }}">
                @if ($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <textarea class="form-control" id="slug" rows="3" name="slug">{{ $book->slug }}</textarea>
                @if ($errors->has('slug'))
                <span class="text-danger">{{ $errors->first('slug') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <textarea class="form-control" id="author" rows="3" name="author">{{ $book->author }}</textarea>
                @if ($errors->has('author'))
                <span class="text-danger">{{ $errors->first('author') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="3" name="description">{{ $book->description }}</textarea>
                @if ($errors->has('description'))
                <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="cover">Cover:</label>
                {{ $book->cover }}
                <p><img src="{{Storage::url('covers/' . $book->cover) }}" alt="" width="20%"></p>
                <input type="file" class="form-control-file" id="cover" name="cover" accept="image/*">
                @if ($errors->has('cover'))
                <span class="text-danger">{{ $errors->first('cover') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection