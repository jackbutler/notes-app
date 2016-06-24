<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $dates = ["created_at","updated_at"];
    protected $fillable = ["note_id","user_id","content"];

    // Define the many to one relationship with users
    public function user()
    {
        return User::find($this->user_id);
    }

    /**
     * Function to make the comment time more human-friendly
     *
     * Checks if the comment was posted today or yesterday, and returns
     * "Today at hh:mm" or "Yesterday at hh:mm" respectively. Otherwise
     * returns "dd/mm/yy at hh:mm"
     *
     * @return string
     */
    public function timeAgo() {

        $commentDate    = $this->created_at->setTime(0, 0, 0);
        $todaysDate     = Carbon::now()->setTime(0, 0, 0);
        $diffInDays     = $todaysDate->diffInDays($commentDate);

        if($diffInDays == 0) {
            return "Today at ".$this->created_at->format("H:i");
        }
        elseif($diffInDays == -1) {
            return "Yesterday at ".$this->created_at->format("H:i");
        }
        else {
            return $this->created_at->format("d/m/y \\a\\t H:i");
        }
    }

    /**
     * Generates the comment HTML to display under the note
     *
     * @return string
     */
    public function generateHtml() {
        $html = "<div class=\"comment clearfix\">
                        <div class=\"col-xs-4 col-sm-2 comment-image\">
                            <div class=\"profile-image-circle\" style=\"background-image:url('{$this->user()->profilePictureUrl()}')\"></div>
                        </div>
                        <div class=\"col-xs-8 col-sm-10 comment-body\">
                            <div class=\"arrow\"></div>
                            <div class=\"row\">
                                <div class=\"col-xs-12 col-sm-8 comment-heading\">
                                    {$this->user()->name()}
                                </div>
                                <div class=\"col-xs-12 col-sm-4 text-right comment-date\">
                                    {$this->timeAgo()}
                                </div>
                                <div class=\"col-xs-12 comment-content\">
                                    {$this->content}
                                </div>
                            </div>
                        </div>
                    </div>";

        return $html;
    }
}
