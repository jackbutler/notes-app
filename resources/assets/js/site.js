/**
 * Created by Jack on 22/06/2016.
 */

$(document).ready(function() {
    $("tr[data-link]").click(function(){
        window.location.href = $(this).data("link");
    });
    $("tr[data-link]").hover(function(){
       $(this).css("cursor","pointer");
    });

});

function toggleCommentForm() {

}