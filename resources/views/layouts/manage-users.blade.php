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
                       @foreach($users as $key => $user)
                           @if($user)
                        <tr>
                            <td class="table-text">
                                <p>{{ $user->name }}</p>
                            </td>
                            <td class="table-text">
                                <p>{{ $user->email }}</p>
                            </td>
                            <td class="table-text">
                                <p>{{ $user->created_at }}</p>
                            </td>
                            <td class="table-text">
                                <p>{{ $user->isAdmin ? 'IsAdmin' : 'IsUser' }}</p>
                                <form method="POST" action="{{ route('setRole', $user->id) }}" accept-charset="UTF-8">
                                    @csrf
                                    <p><select name="blocking" class="select">
                                        @if ($user->isAdmin)
                                        <option value="0">User</option>
                                        @else
                                        <option value="1">Admin</option>
                                        @endif
                                    </select></p>
                                    <p><input type="submit" name="action" class="b1" value="Set role"></p>
                                </form>
                            </td>
                            <td class="table-text">
                                <form method="POST" action="{{ route('destroyUser', $user->id) }}" accept-charset="UTF-8">
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