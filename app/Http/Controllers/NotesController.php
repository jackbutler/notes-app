<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Note;
use Illuminate\Http\Request;

use App\Http\Requests;

class NotesController extends Controller
{
    /**
     *  Retrieve all the notes and return the "Notes Overview" view
     *
     * @return mixed
     */
    public function getNotes() {
        $notes = Note::orderBy("created_at","desc")->get();

        if(\Auth::user()->profile_picture == "")
            \Flash::warning("You have not set a profile picture. Go to \"My Profile\" to set one now");

        return view("notesOverview",[
            "notes" => $notes
        ]);
    }

    /**
     * Returns the "Add New Note" view
     *
     * @return mixed
     */
    public function addNote() {
        return view("noteAdd");
    }

    /**
     * Process the new note, and redirect to the newly created note
     *
     * @return mixed
     */
    public function createNote(Request $request) {

        $rules = [
            'title' => 'required',
            'content' => 'required',
        ];

        $this->validate($request, $rules);

        $note = new Note([
            'title'     => $request->input("title"),
            'content'   => $request->input("content")
        ]);

        // Get the logged in user
        $user = \Auth::user();

        // Associate the note with the user
        $user->notes()->save($note);

        \Flash::success("Note created successfully");

        return redirect("/notes/$note->id");
    }

    /**
     * Retrieves the note and returns the "View note" view
     *
     * @param $note_id
     * @return mixed
     */
    public function viewNote($note_id) {

        $note = Note::find($note_id);

        if(!$note) {
            abort(404);
        }
        return view("noteView",["note"=>$note]);
    }

    /**
     * Processes the posted comment, received via AJAX.
     *
     * Aborts on error, returns the comment HTML on success
     *
     * @param $note_id
     * @return mixed
     */
    public function postComment(Request $request, $note_id) {

        $note = Note::find($note_id);

        if(!$note) {
            abort(404);
        }

        if($request->input("content") == "") {
            abort(400);
        }

        $user_id = \Auth::user()->id;

        $comment = new Comment([
            "user_id"   => $user_id,
            "content"   => $request->input("content")
        ]);

        // Associate the comment with the note
        $note->comments()->save($comment);

        // Generate the comment HTML and return it.
        return response($comment->generateHtml());
    }

    /**
     * Deletes a note
     *
     * Verifies the user actioning the delete is the notes author,
     * then deletes the note and redirects to the Notes Overview
     * @return mixed
     */
    public function deleteNote($note_id) {
        $note = Note::find($note_id);
        $user = \Auth::user();

        if(!$note) {
            abort(404);
        }

        // Verify the note is being deleted by its author
        if($user->id != $note->user_id) {
            abort(403);
        }

        $note->delete();

        \Flash::success("Note successfully deleted");
        return redirect("/");
    }
}
