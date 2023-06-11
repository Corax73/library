@extends('admin-forms')

@section('form')
<div class="container">
                                        <form enctype="multipart/form-data" action="{{ route('addCategory') }}" method="post" style="border: 4px double black">
                                            @csrf
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Title</span>
                                                <input name="title" type="text" class="form-control" placeholder="Title" aria-label="Server">
                                            </div>
                                            @if ($errors->has('title'))
                                            <span class="text-danger">{{ $errors->first('title') }}</span>
                                            @endif
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Slug</span>
                                                <input name="slug" type="text" class="form-control" placeholder="Slug" aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                            @if ($errors->has('slug'))
                                            <span class="text-danger">{{ $errors->first('slug') }}</span>
                                            @endif
                                            <p><input type="submit" name="action" class="b1" value="Save"></p>
                                            </form>
                                    </div>
@endsection