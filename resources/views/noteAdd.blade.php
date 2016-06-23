@extends("base")

@section("title","New Note")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1 content-box">
                <div class="page-header">
                    <h1>New Note</h1>
                </div>
                {{-- Display any form errors --}}
                @if (count($errors))
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="form" data-toggle="validator" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group required has-feedback">
                        <label for="title" class="control-label">Title</label>
                        <input class="form-control input-lg" name="title" id="title" value="{{ old('title') }}" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Note Content</label>
                        <textarea class="tinymce" rows="20" name="content"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 form-group">
                            <a class="btn btn-default" href="{{ url("/") }}">Cancel</a>
                        </div>
                        <div class="col-xs-6 text-right form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop