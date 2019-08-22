@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <a href="{{route('edit.profile', $user->id)}}" class="btn btn-primary">
                    <span class="fa fa-edit"></span>
                    Edit Profile
                </a>
                {{--<a href="{{route('print.profile', $user->id)}}" class="btn btn-info">--}}
                    {{--<span class="fa fa-print"></span>--}}
                    {{--Print Profile--}}
                {{--</a>--}}
            </div>
        </div>
        <div class="row">

            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">User Profile</div>

                    <div class="card-body">
                        <div class="container" style="margin-top: 10px">

                            <div class="form-group row">
                                <div class="media">
                                    @if ($user->image)
                                        <div class="col-md-6">
                                            <img class="media-object" alt=""
                                                 src="{{url('storage/users/'.$user->image)}}" width="120" height="120">
                                        </div>
                                    @else
                                        <div class="col-md-6">
                                            <img class="media-object" alt="{{'no image'}}" src="{{asset("images/mm.jpg")}}"
                                                 width="120" height="120">

                                        </div>
                                    @endif
                                </div>


                            </div>

                            <form method="POST" action="{{''}}">
                                @csrf

                                <fieldset class="form-group"><legend>Personal Details:</legend>


                                    <div class="row">

                                        <div class="col-lg-4">
                                            <div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
                                                <label for="fname" class="control-label">Name<span style="color: red">*</span></label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                       value="{{old('name') ? : $user->name }}" readonly>
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
<strong>{{ $errors->first('name') }}</strong>
</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
                                                <label for="nickname" class="control-label">Nickname<span style="color: red">*</span></label>
                                                <input type="text" class="form-control" id="nickname" name="nickname"
                                                       value="{{old('nickname') ? : $user->nickname }}" readonly>
                                                @if ($errors->has('nickname'))
                                                    <span class="help-block">
<strong>{{ $errors->first('nickname') }}</strong>
</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group{{ $errors->has('facebook_username') ? ' has-error' : '' }}">
                                                <label for="mname" class="control-label">Facebook Username</label>
                                                <input type="text" class="form-control" id="mname" name="facebook_username"
                                                       value="{{old('facebook_username') ? : $user->facebook_username }}" readonly>
                                                @if ($errors->has('facebook_username'))
                                                    <span class="help-block">
<strong>{{ $errors->first('facebook_username') }}</strong>
</span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">


                                        <div class="col-lg-4">
                                            <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                                                <label for="dob" class="control-label">Date of Birth<span style="color: red">*</span></label>
                                                <input type="text" name="dob" class="form-control" id="dob"
                                                       value="{{old('dob') ? : $user->dob}}" readonly>
                                                @if ($errors->has('dob'))
                                                    <span class="help-block">
                                            <strong>{{ $errors->first('dob') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group{{ $errors->has('marital_status') ? ' has-error' : '' }}">
                                                <label for="marital_status" class="control-label">Marital Status<span style="color: red">*</span></label>
                                                <select class="form-control" name="marital_status" readonly>
                                                    @foreach($data['marital'] as $title)
                                                        <option value="{{$title['value']}}"
                                                                {{Auth::user()->marital_status == $title['value'] ? 'selected' : ''}}>
                                                            {{$title['title']}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('marital_status'))
                                                    <span class="help-block">
<strong>{{ $errors->first('marital_status') }}</strong>
</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                                <label for="state" class="control-label" >State</label>
                                                <select id="student-state" class="form-control" name="state_id" disabled>
                                                    <option value="">Select State</option>
                                                    @foreach(\App\State::all() as $state)
                                                        <option value="{{$state->id}}"
                                                                {{$user->state == $state->id ? 'selected' : ''}}
                                                        >{{$state->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('state'))
                                                    <span class="help-block">
                                            <strong>{{ $errors->first('state') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label for="email" class="control-label">Email<span style="color: red">*</span></label>
                                                <input class="form-control" type="email"
                                                       value="{{old('email') ? : $user->email}}" readonly>
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                                <label for="phone" class="control-label">Phone Number<span style="color: red">*</span></label>
                                                <input type="text" name="phone" class="form-control" id="phone"
                                                       value="{{old('phone') ? : $user->phone }}" readonly>
                                                @if ($errors->has('phone'))
                                                    <span class="help-block">
<strong>{{ $errors->first('phone') }}</strong>
</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group{{ $errors->has('alt_phone') ? ' has-error' : '' }}">
                                                <label for="alt_phone" class="control-label">Alternative Phone Number</label>
                                                <input type="text" name="alt_phone" class="form-control" id="alt_phone"
                                                       value="{{old('alt_phone') ? : $user->alt_phone }}" readonly>
                                                @if ($errors->has('alt_phone'))
                                                    <span class="help-block">
<strong>{{ $errors->first('alt_phone') }}</strong>
</span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                        <label for="location" class="control-label">Permanent Address<span style="color: red">*</span></label>
                                        <textarea name="address" class="form-control" id="address" readonly>{{old('address') ? : $user->address}}</textarea>
                                        @if ($errors->has('address'))
                                            <span class="help-block">
<strong>{{ $errors->first('address') }}</strong>
</span>
                                        @endif
                                    </div>

                                </fieldset>

                                <fieldset class="form-group"><legend>Moments/Experiences:</legend>


                                    <div class="row">

                                        <div class="col-lg-4">
                                            <div class="form-group{{ $errors->has('best_course') ? ' has-error' : '' }}">
                                                <label for="best_course" class="control-label">Best Course<span style="color: red">*</span></label>
                                                <input type="text" class="form-control" id="best_course" name="best_course"
                                                       value="{{old('best_course') ? : $user->best_course }}" readonly>
                                                @if ($errors->has('best_course'))
                                                    <span class="help-block">
<strong>{{ $errors->first('best_course') }}</strong>
</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group{{ $errors->has('best_lecturer') ? ' has-error' : '' }}">
                                                <label for="nickname" class="control-label">Best Lecturer<span style="color: red">*</span></label>
                                                <input type="text" class="form-control" id="best_lecturer" name="best_lecturer"
                                                       value="{{old('best_lecturer') ? : $user->best_lecturer }}" readonly>
                                                @if ($errors->has('best_lecturer'))
                                                    <span class="help-block">
<strong>{{ $errors->first('best_lecturer') }}</strong>
</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group{{ $errors->has('worst_course') ? ' has-error' : '' }}">
                                                <label for="worst_course" class="control-label">Worst Course</label>
                                                <input type="text" class="form-control" id="worst_course" name="worst_course"
                                                       value="{{old('worst_course') ? : $user->worst_course }}" readonly>
                                                @if ($errors->has('worst_course'))
                                                    <span class="help-block">
<strong>{{ $errors->first('facebook_username') }}</strong>
</span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">


                                        <div class="col-lg-6">
                                            <div class="form-group{{ $errors->has('hobbies') ? ' has-error' : '' }}">
                                                <label for="hobbies" class="control-label">Hobbies<span style="color: red">*</span></label>
                                                <textarea class="form-control" name="hobbies" readonly>{{old('hobbies') ? : $user->hobbies }}</textarea>
                                                @if ($errors->has('hobbies'))
                                                    <span class="help-block">
                                            <strong>{{ $errors->first('hobbies') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group{{ $errors->has('likes_dislikes') ? ' has-error' : '' }}">
                                                <label for="likes_dislikes" class="control-label">Likes/Dislikes<span style="color: red">*</span></label>
                                                <textarea class="form-control" name="hobbies" readonly>{{old('likes_dislikes') ? : $user->likes_dislikes }}</textarea>
                                                @if ($errors->has('likes_dislikes'))
                                                    <span class="help-block">
<strong>{{ $errors->first('likes_dislikes') }}</strong>
</span>
                                                @endif
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">


                                        <div class="col-lg-6">
                                            <div class="form-group{{ $errors->has('best_moment') ? ' has-error' : '' }}">
                                                <label for="best_moment" class="control-label">Best Moment<span style="color: red">*</span></label>
                                                <textarea class="form-control" name="hobbies" readonly>{{old('best_moment') ? : $user->best_moment }}</textarea>
                                                @if ($errors->has('best_moment'))
                                                    <span class="help-block">
                                            <strong>{{ $errors->first('best_moment') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group{{ $errors->has('worst_moment') ? ' has-error' : '' }}">
                                                <label for="worst_moment" class="control-label">Worst Moment<span style="color: red">*</span></label>
                                                <textarea class="form-control" name="worst_moment" readonly>{{old('worst_moment') ? : $user->worst_moment }}</textarea>
                                                @if ($errors->has('worst_moment'))
                                                    <span class="help-block">
<strong>{{ $errors->first('worst_moment') }}</strong>
</span>
                                                @endif
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group{{ $errors->has('most_admired') ? ' has-error' : '' }}">
                                                <label for="most_admired" class="control-label">Most Admired Colleague<span style="color: red">*</span></label>
                                                <input class="form-control" type="text"
                                                       value="{{old('most_admired') ? : $user->most_admired}}" readonly>
                                                @if ($errors->has('most_admired'))
                                                    <span class="help-block">
                                            <strong>{{ $errors->first('most_admired') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group{{ $errors->has('role_model') ? ' has-error' : '' }}">
                                                <label for="role_model" class="control-label">Role Model</label>
                                                <input type="email" name="role_model" class="form-control" id="role_model"
                                                       value="{{old('role_model') ? : $user->role_model }}" readonly>
                                                @if ($errors->has('role_model'))
                                                    <span class="help-block">
<strong>{{ $errors->first('role_model') }}</strong>
</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group{{ $errors->has('future_aspiration') ? ' has-error' : '' }}">
                                                <label for="future_aspiration" class="control-label">Future Aspiration<span style="color: red">*</span></label>
                                                <input type="text" name="future_aspiration" class="form-control" id="future_aspiration"
                                                       value="{{old('future_aspiration') ? : $user->future_aspiration }}" readonly>
                                                @if ($errors->has('future_aspiration'))
                                                    <span class="help-block">
<strong>{{ $errors->first('future_aspiration') }}</strong>
</span>
                                                @endif
                                            </div>
                                        </div>


                                    </div>


                                </fieldset>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')

    <script type="text/javascript">
        $(document).ready( function () {

            $('#state').on('change', function (e) {
                var state = e.target.value;

                $('#lga').empty();
                $.get('{{ url('lgas-json') }}'+'?state='+state, function(data) {
                    $.each(data, function(index,subCatObj){
                        $('#lga').append('<option value="' + subCatObj.id +'">'
                            + subCatObj.name +'</option>');
                    });

                });
            });

            var date_input=$("#date-picker"); //our date input has the name "date"
            var options={
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                autoclose: true,
            };
            date_input.datepicker(options);

        } );
    </script>

@endsection
