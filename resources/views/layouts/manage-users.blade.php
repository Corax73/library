@extends('admin-forms')

@section('form')
<div class="container">
{{ $users->links() }}
    <table border="5px" align="center">
                     <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created_at</th>
                        <th>Update</th>
                        <th>IsAdmin</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                       @foreach($users as $key => $user)
                           @if($user)
                        <tr>
                        <form method="post" action="{{ route('userUpdate', $user->id) }}">
                            @csrf
                            @method ('patch')
                            <td class="table-text">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="name" value="{{ $user->name }}">
                                    @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="table-text">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="email" value="{{ $user->email }}">
                                    @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="table-text">
                                <p>{{ $user->created_at }}</p>
                            </td>
                            <td>
                            <button type="submit" class="btn btn-primary">Update</button>
                            </td>
                            </form>
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
                {{ $users->links() }}
</div>
@endsection