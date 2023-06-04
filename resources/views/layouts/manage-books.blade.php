@extends('admin-forms')

@section('form')
<div class="container">
    <table border="5px" align="center">
                     <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created_at</th>
                        <th>IsAdmin</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                       @foreach($books as $key => $book)
                           @if($book)
                        <tr>
                            <td class="table-text">
                                <p>{{ $book->title }}</p>
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
</div>
@endsection