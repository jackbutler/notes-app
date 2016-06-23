@extends("base")

@section("title","Notes Overview")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1 content-box">
                <div class="page-header">
                    <h1>Notes Overview</h1>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Created By</th>
                                <th>Title</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notes as $note)
                                <tr data-link="{{ url("/notes/$note->id") }}">
                                    <th>{{ $note->user->name() }}</th>
                                    <th>{{ $note->title }}</th>
                                    <th>{{ $note->created_at->format("d/m/y \\a\\t H:i") }}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <p>
                    <a href="{{ url("notes/add") }}" class="btn btn-primary arrow">Create a new note</a>
                </p>
            </div>
        </div>
    </div>
@stop