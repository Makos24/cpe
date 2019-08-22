@extends('layouts.admin')

@section('content')

    @include('admin.modals.upload')

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
        @if(Auth::user()->level == 1)
        <div class="col-md-5 float-right">
            <a class="btn btn-info" href="{{route('users.export')}}">
                <span class="fa fa-file-excel"></span>
                Export Excel
            </a>
            <a class="btn btn-info" href="{{route('images.download')}}">
                <span class="fa fa-download"></span>
                Download Images
            </a>
            {{--<button data-toggle="modal" data-target="#uploadStudents" type="button" class="btn btn-primary">--}}
                {{--<i class="fa fa-upload"></i>--}}
                {{--Upload Students--}}
            {{--</button>--}}
        </div>
        @endif
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Registered Users</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Student ID</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Student ID</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection

@section('footer')
    <script type="text/javascript">
        function htmlDecode(data){
            var txt=document.createElement('textarea');
            txt.innerHTML=data;
            return txt.value
        }
    </script>
    <script>
        $(document).ready( function () {
            $('#dataTable').DataTable({
                "saveState": true,
                "processing": true,
                "serverSide": true,
                "ajax": '{{ route('users.ajax') }}',
                "columns": [
                    { data: "id" },
                    { data: "name" },
                    { data: "student_id" },
                    { data: "email" },
                    { data: "phone" },
                    { data: "actions",
                        render: function(data){
                            return htmlDecode(data);
                        }
                    }
                ],
                columnDefs: [
                    { "width": "25%", "targets": 5}
                ]
            });

            $(document).on('click', '#btn-delete-user', function() {
                if(confirm('Are you sure you want to Disable this User?')){
                    this.form.submit();
                }

            }) ;
            $(document).on('click', '#btn-confirm-user', function() {
                if(confirm('Are you sure you want to Confirm this User?')){
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