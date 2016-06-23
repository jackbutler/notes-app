@extends("base")

@section("title", $user->name())

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1 content-box">
                <div class="page-header">
                    <h1>Edit Profile</h1>
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
                <div class="col-xs-12 col-sm-6">
                    <h2>Profile Picture</h2>
                    {{-- If there is a profile picture, show it. Otherwise, show "no picture set" --}}
                    @if($user->profile_picture!="")
                    <div class="clearfix">
                        <div class="col-xs-8 col-sm-6 col-md-4 thumbnail">
                            <img class="img-responsive" src="{{ url("uploads/$user->profile_picture") }}">
                        </div>
                    </div>
                    @else
                        <span class="text-danger">No profile picture set!</span>
                    @endif
                    <h3>Upload New Picture</h3>
                    <form name="uploadProfilePicture" method="post" enctype="multipart/form-data" action="{{ url("profile/picture") }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="file" name="profile_picture" required>
                        </div>
                        <p>
                            <button type="submit" class="btn btn-primary arrow">Upload</button>
                        </p>
                    </form>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <h2>Update Your Details</h2>
                    <form class="form" data-toggle="validator" method="post" name="update_details" action="{{ url("profile/details") }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-6 required has-feedback">
                                <label for="first_name" class="control-label">First Name</label>
                                <input class="form-control" name="first_name" id="first_name" value="{{ $user->first_name }}" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-6 required has-feedback">
                                <label for="last_name" class="control-label">Last Name</label>
                                <input class="form-control" name="last_name" id="last_name" value="{{ $user->last_name }}" required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 required has-feedback">
                                <label for="email" class="control-label">Email</label>
                                <input class="form-control" name="email" id="email" type="email" value="{{ $user->email }}" required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop