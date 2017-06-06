@extends('../layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            {{-- USER INFO --}}
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Your information</div>
                    <div class="panel-body">

                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ url('/user/profile') }}" autocomplete="on">

                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <div class="form-group form-group-wlabel">
                                <div class="col-md-4{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                    <label for="first_name">First name</label>
                                    <input type="text" class="form-control" id="first_name" value="{{ $user['first_name'] }}" name="first_name">
                                    <i class="fa fa-user"></i>
                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif

                                </div>

                                <div class="col-md-4{{ $errors->has('middle_name') ? ' has-error' : '' }}">
                                    <label for="middle_name">Middle name</label>
                                    <input type="text" class="form-control" id="middle_name" value="{{ $user['middle_name'] }}" name="middle_name">
                                    <i class="fa fa-user"></i>
                                    @if ($errors->has('middle_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('middle_name') }}</strong>
                                        </span>
                                    @endif

                                </div>

                                <div class="col-md-4{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    <label for="last_name">Last name</label>
                                    <input type="text" class="form-control" id="last_name" value="{{ $user['last_name'] }}" name="last_name">
                                    <i class="fa fa-user"></i>
                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group form-group-wlabel">
                                <div class="col-md-6">
                                    <label for="role">Role</label>
                                    <input type="text" class="form-control text-postcodeitalize" id="role" value="{{ $user_role }}" disabled>
                                    <i class="fa fa-user-secret"></i>
                                </div>

                                <div class="col-md-6{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email">E-mail address</label>
                                    <input type="email" class="form-control" id="email" value="{{ $user['email'] }}" name="email">
                                    <i class="fa fa-envelope"></i>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group form-group-wlabel">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Update info</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
            {{-- /USER INFO --}}

            {{-- PASSWORD --}}
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Change password
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ url('/user/password') }}" autocomplete="off">

                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <div class="form-group form-group-wlabel{{ $errors->has('current_password') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <label for="current_password">Current password</label>
                                    <input type="password" class="form-control" id="current_password"
                                           name="current_password">
                                    <i class="fa fa-lock"></i>

                                    @if ($errors->has('current_password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('current_password') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group form-group-wlabel{{ $errors->has('new_password') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <label for="new_password">New password</label>
                                    <input type="password" class="form-control" id="new_password"
                                           name="new_password">
                                    <i class="fa fa-lock"></i>

                                    @if ($errors->has('new_password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('new_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group form-group-wlabel{{ $errors->has('new_password') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <label for="new_password_confirmation">New password confirmation</label>
                                    <input type="password" class="form-control" id="new_password_confirmation"
                                           name="new_password_confirmation">
                                    <i class="fa fa-lock"></i>

                                    @if ($errors->has('new_password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('new_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group form-group-wlabel">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Change password</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                {{-- /PASSWORD --}}

            </div>
        </div>
    </div>
@endsection
