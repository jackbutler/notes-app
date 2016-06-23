@extends("base")

@section("title","Register")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 auth-box content-box">
                <div class="page-header">
                    <h1>Register</h1>
                </div>
                @if (count($errors))
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="form" data-toggle="validator" data-disable="true" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-6 required has-feedback">
                            <label for="first_name" class="control-label">First Name</label>
                            <input class="form-control" name="first_name" id="first_name" value="{{ old('first_name') }}" required>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 required has-feedback">
                            <label for="last_name" class="control-label">Last Name</label>
                            <input class="form-control" name="last_name" id="last_name" value="{{ old('last_name') }}" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-12 required has-feedback">
                            <label for="email" class="control-label">Email</label>
                            <input class="form-control" name="email" id="email" type="email" value="{{ old('email') }}" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-6 required has-feedback">
                            <label for="password" class="control-label">Password</label>
                            <input class="form-control" name="password" id="password" type="password" data-minlength="6" required>
                            <div class="help-block">Minimum of 6 characters</div>
                        </div>
                        <div class="form-group required col-sm-6 has-feedback">
                            <label for="password_confirmation" class="control-label">Confirm Password</label>
                            <input class="form-control" name="password_confirmation" id="password_confirmation" type="password" data-match="#password" data-match-error="Your passwords don&apos;t match!" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 form-group">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop