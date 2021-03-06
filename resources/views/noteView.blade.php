@extends("base")

@section("title", $note->title)

@section("head_extras")
    <script type="text/javascript">

        function deleteNote() {
            var r = confirm("Are you sure you want to delete this note? This cannot be undone");
            if(r == true) {
                window.location.href = "{{ url("notes/{$note->id}/delete") }}";
            }
        }

        $(document).ready(function(){
            // Bind the AJAX submission to the Post Comment submit button
            $('#add_comment_submit').click(function(){
                $.ajax({
                    url: '{{ url("notes/{$note->id}/comments") }}',
                    type: "post",
                    data: {
                        'content':$('#add_comment_content').val(),
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function(data){
                        // Insert the comment HTML into the comment thread
                        $(".comments").prepend(data);
                        // Empty and hide the comment form
                        $("#commentForm").collapse('hide');
                        $('#add_comment_content').val("");
                    }
                });
                return false;
            });
        });
    </script>
@stop

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1 content-box">
                <div class="page-header">
                    <h1>{{ $note->title }}</h1>
                </div>
                <div class="note-content well">
                    {!! $note->content !!}
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 form-group">
                        <a class="btn btn-default" href="{{ url("/") }}">&lt; Back to Overview</a>
                    </div>
                    <div class="col-xs-12 col-sm-6 text-right form-group">
                        {{-- Show delete button if the current user is the note author --}}
                        @if($note->user_id == \Auth::user()->id)
                            <button class="btn btn-danger" onclick="deleteNote()">Delete Note</button>
                        @endif
                        <button class="btn btn-primary" data-toggle="collapse" data-target="#commentForm" >Add Additional Note</button>
                    </div>
                </div>
                <div id="commentForm" class="collapse">
                    <div class="well clearfix">
                        <form name="add_comment" class="form">
                            <div class="col-xs-8 col-xs-offset-2 col-sm-10 col-sm-offset-1">
                                <div class="form-group">
                                    <textarea name="add_comment_content" class="form-control" rows="4" id="add_comment_content"></textarea>
                                </div>

                                <p class="text-right">
                                    <button type="submit" class="btn btn-primary arrow btn-sm" id="add_comment_submit">Post</button>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="comments">
                    @foreach ($note->comments as $comment)
                        {!! $comment->generateHtml() !!}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop