@extends('layouts.admin')

@section('content')
    @include('admin.add-user')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="has-error">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="col-md-5">
            <button data-toggle="modal" data-target="#createUser" type="button" class="btn btn-primary">
                <i class="fa fa-user-plus"></i>
                Create Admin
            </button>
        </div>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Registered Admins</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Admin Type</th>
                        <th>Reg. Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->level == 1 ? 'Active Admin' : 'Passive Admin' }}</td>
                                <td>{{$user->created_at}}</td>
                                <td>
                                    @if($user->deleted_at == null)
                                        <form action="{{route('destroy.profile', $user->id)}}" method="POST" id="dForm">
                                            {{ csrf_field() }}
                                            <button type="button" class="btn btn-danger" id="btn-delete-user">
                                                <span class="fa fa-trash"></span>
                                                Deactivate</button>
                                        </form>
                                    @else
                                        <form action="{{route('restore.profile')}}" method="POST" id="rForm">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{{$user->id}}" name="id">
                                            <button type="button" class="btn btn-success" id="btn-restore-user">
                                                <span class="fa fa-undo-alt"></span>
                                                Restore</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection

@section('footer')

    <script>
        $(document).ready( function () {

            $(document).on('click', '#btn-delete-user', function() {
                if(confirm('Are you sure you want to Disable this User?')){
                    this.form.submit();
                }

            }) ;
            $(document).on('click', '#btn-restore-user', function() {
                if(confirm('Are you sure you want to Restore this User?')){
                    this.form.submit();
                }

            });

        } );

    </script>
@endsection