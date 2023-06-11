@extends('admin-forms')

@section('form')
<div class="container">
    <table border="5px" align="center">
                     <thead>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Created_at</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                       @foreach($categories as $key => $category)
                           @if($category)
                        <tr>
                        <form method="post" action="{{ route('categoryUpdate', $category->id) }}">
                            @csrf
                            @method ('patch')
                            <td class="table-text">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="title" value="{{ $category->title }}">
                                    @if ($errors->has('title'))
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="table-text">
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="slug" value="{{ $category->slug }}">
                                    @if ($errors->has('slug'))
                                    <span class="text-danger">{{ $errors->first('slug') }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="table-text">
                                <p>{{ $category->created_at }}</p>
                            </td>
                            <td>
                            <button type="submit" class="btn btn-primary">Update</button>
                            </td>
                            </form>
                            <td class="table-text">
                                <form method="POST" action="{{ route('destroyCategory', $category->id) }}" accept-charset="UTF-8">
                                @csrf
                                @method ('delete')
                                <p><input type="submit" name="action" class="b1" value="❌"></p>
                                </form>
                            </td>
                        </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
</div>
@endsection