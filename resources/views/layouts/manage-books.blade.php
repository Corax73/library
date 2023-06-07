@extends('admin-forms')

@section('form')
<div class="container">
{{ $books->links() }}
    <table border="5px" align="center">
                     <thead>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Slug</th>
                        <th>Created_at</th>
                        <th>Description</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                       @foreach($books as $key => $book)
                           @if($book)
                        <tr>
                            <td class="table-text">
                                <p><a href="{{ route('bookEdit', $book->id) }}">{{ $book->title }}</a></p>
                            </td>
                            <td class="table-text">
                                <p>{{ $book->author }}</p>
                            </td>
                            <td class="table-text">
                                <p>{{ $book->slug }}</p>
                            </td>
                            <td class="table-text">
                                <p>{{ $book->created_at }}</p>
                            </td>
                            <td class="table-text">
                                <p class="post">{{ $book->description }}</p>
                            </td>
                            <td class="table-text">
                                <form method="POST" action="{{ route('destroyBook', $book->id) }}" accept-charset="UTF-8">
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
                {{ $books->links() }}
</div>
@endsection