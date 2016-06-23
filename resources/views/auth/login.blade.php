@extends("base")

@section("title","Login")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 auth-box content-box">
                <div class="page-header">
                    <h1>Login</h1>
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
                    <div class="form-group required has-feedback">
                        <label for="email" class="control-label">Username/Email</label>
                        <input class="form-control" name="email" id="email" type="email" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group required has-feedback">
                        <label for="password" class="control-label">Password</label>
                        <input class="form-control" name="password" id="password" type="password" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 form-group">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                        <div class="col-xs-6 text-right form-group">
                            <a class="btn btn-info" href="{{ url("register") }}">Register</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop