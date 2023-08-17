@extends('admin-forms')

@section('form')
<div class="container">
                                        <form enctype="multipart/form-data" action="{{ route('addBook') }}" method="post" style="border: 4px double black">
                                            @csrf
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Title</span>
                                                <input name="title" type="text" class="form-control" placeholder="Title" aria-label="Server" value="{{ old('title') }}">
                                            </div>
                                            @if ($errors->has('title'))
                                            <span class="text-danger">{{ $errors->first('title') }}</span>
                                            @endif
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Slug</span>
                                                <input name="slug" type="text" class="form-control" placeholder="Slug" aria-label="Username" aria-describedby="basic-addon1" value="{{ old('slug') }}">
                                            </div>
                                            @if ($errors->has('slug'))
                                            <span class="text-danger">{{ $errors->first('slug') }}</span>
                                            @endif
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Author</span>
                                                <input name="author" type="text" class="form-control" placeholder="Author" aria-label="Username" aria-describedby="basic-addon1" value="{{ old('author') }}">
                                            </div>
                                            @if ($errors->has('author'))
                                            <span class="text-danger">{{ $errors->first('author') }}</span>
                                            @endif
                                            <div class="input-group">
                                                <span class="input-group-text">Description</span>
                                                <textarea name="description" class="form-control" aria-label="With textarea" >{{ old('description') }}</textarea>
                                            </div>
                                            @if ($errors->has('description'))
                                            <span class="text-danger">{{ $errors->first('description') }}</span>
                                            @endif
                                            <div class="input-group">
                                                <label for="image">Cover</label>
                                                <input type="file" class="form-control-file" id="cover" name="cover" accept="image/*">
                                                @if ($errors->has('cover'))
                                                <span class="text-danger">{{ $errors->first('cover') }}</span>
                                                @endif
                                            </div>
                                            <p><input type="submit" name="action" class="b1" value="Save"></p>
                                            </form>
                                    </div>
@endsection