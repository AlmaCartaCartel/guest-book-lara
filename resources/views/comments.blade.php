<?php
       function renderComments($comments)
           {

               foreach ($comments as $comment):
                    $answer = '';
                    if (\Illuminate\Support\Facades\Auth::check()){
                        $answer = "<button
                            class='answer btn btn-secondary'
                            data-parent='{$comment -> parent}'
                            data-commentid ='{$comment -> id}'>
                            answer
                        </button>";
                    }
               ?>
                   <div class="comment" >

                       <h3 class="author">
                           <?php echo $comment -> user_name ?>
                       </h3>
                       <pre>
                           <?php echo $comment -> message ?>
                       </pre>
                       <div class="d-flex justify-content-between">
                           <?php echo $answer?>
                           <span><?php echo $comment -> updated_at ?></span>
                       </div>
                   </div>

                   <ul class="answers " style="list-style: none; margin-left: 30px" data-commentid="<?php echo $comment->id?>" >
                       <?php renderComments($comment -> answers)?>
                   </ul>
                <?php
                endforeach;
           }
   ?>
<div class="comments">
    <?php renderComments($comments); ?>
</div>
    {{ $comments-> links() }}
