@extends('layouts.app')

    @section('content')

        @include('admin.layouts.partials_admin.sidebar-admin')
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
    <div class="container AdminContainer col-md-offset-2" style="margin-left:234px">
            @include('admin.layouts.partials_admin.navbar-admin')
                <h1 style="margin-left:20px">All the Users</h1>
                    <!-- will be used to show any messages -->
                    @if (Session::has('message'))
                        <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif  
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Status Level</td>
                                <td>Actions</td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($users->all() as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->is_admin }}</td>
                                <td>
                                    {{ Form::open(array('url' => 'userManage/' . $user->id, 'class' => 'col-md-4')) }}
                                        {{ Form::hidden('_method', 'DELETE') }}
                                        {{ Form::submit('Delete this user', array('class' => 'btn btn-warning','onclick'=>"return confirm('Are you sure?')")) }}
                                    {{ Form::close() }}
                                    <a class="btn btn-small btn-success" href='{{ url("/userManage/{$user->id}")}}'>Show this user</a>
                                    <a class="btn btn-small btn-info" href='{{ url("/userManage/{$user->id}/edit")}}'>Edit this user</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
    </div>
    @endsection