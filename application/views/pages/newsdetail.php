<?php include('head.php'); ?>
<?php include ('navigator.php'); ?>
<div class="container">
    <div class="row detail-news-header">
        <img src="../schoolm/assets/images/news/mm_<?php echo $news[0]['newspicture'] ?>" alt="berita seputar pendidikan">
    </div>
    <div class="row detail-news-title">
        <div class="col-lg-12">
            <h1><?php echo $news[0]['newstitle'] ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?php echo $news[0]['newsbody'] ?>
        </div>
    </div>
    <?php if($loginFrom != "")
    {?>
        <div class="row">
            <div class="col-lg-12">
                <form action="NewsController/insertComment" method="POST">
                    <input type="text" name="newsId" style="display:none;" value="<?php echo $news[0]['newsid'] ?>">
                    <div class="form-group">
                        <textarea class="form-control" name="newsComment" required placeholder="masukkan komentar.." rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="float-right">
                            <input type="submit" class="btn btn-primary" value="submit"></input>
                        </div>
                    </div>
                </form>
            </div>
        </div><br>
        <?php foreach($comment as $comments)
        {?>
        <div class="row alert first-comment">
            <div class="col-lg-12">
                <?php 
                    $email = $comments->email;
                    $cut = explode("@", $email);
                    $name = $cut[0];
                ?>
                <h1><?php echo $name ?></h1>
                <?php
                    $emailComment = $userEmail;
                    $cutComment = explode("@", $emailComment);
                    $nameComment = $cutComment[0];
                    if($name == $nameComment)
                    {
                        ?>
                            <button data-id="<?php echo $comments->commentid ?>" data-news="<?php echo $news[0]['newsid'] ?>" class="delete-comment close"><span aria-hidden="true">&times;</span></button>
                        <?php
                    }
                ?>
                <h2><?php 
                echo $comments->comment_date;
                ?></h2>  
            </div>
            <div class="col-lg-12">
                <?php echo $comments->comment_desc ?>
            </div>
            <div class="col-lg-12"> 
                <div class="float-right reply">
                    <span id="likecomment-<?php echo $comments->commentid ?>" class="likecomment"><?php echo count($comments->liketotal) ?></span>
                    <span class="like-comment likecomment" data-id="<?php echo $comments->commentid ?>" data-news="<?php echo $news[0]['newsid'] ?>"><i class="fa fa-angle-up"></i></span>
                    <span id="dislikecomment-<?php echo $comments->commentid ?>" class="likecomment"><?php echo count($comments->disliketotal) ?></span>
                    <span class="dislike-comment likecomment" data-id="<?php echo $comments->commentid ?>" data-news="<?php echo $news[0]['newsid'] ?>"><i class="fa fa-angle-down"></i></span>
                    <span class="likecomment"><i class="fa fa-circle"></i></span>
                    <p class="replyComment" data-id="<?php echo $comments->commentid ?>">Reply</p>
                </div>
            </div>
        </div>
        <div class="row" id="<?php echo $comments->commentid ?>" style="display:none">
            <div class="col-lg-12">
                <form action="NewsController/insertReply" method="POST">
                    <input type="text" name="newsId" style="display:none;" value="<?php echo $news[0]['newsid'] ?>">
                    <input type="text" name="commentId" style="display:none;" value="<?php echo $comments->commentid ?>">
                    <div class="form-group">
                        <textarea class="form-control" required name="replyComment" placeholder="masukkan komentar.." rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="float-right">
                            <input type="submit" class="btn btn-primary" value="submit"></input>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php foreach($comments->replys as $comments_reply)
        {?>
            <div class="row alert second-comment">
                <div class="col-lg-12">
                    <?php 
                        $email = $comments_reply->email;
                        $cut = explode("@", $email);
                        $name = $cut[0];
                    ?>
                    <h1><?php echo $name ?></h1>
                    <?php
                        $emailComment = $userEmail;
                        $cutComment = explode("@", $emailComment);
                        $nameComment = $cutComment[0];
                        if($name == $nameComment)
                        {
                            ?>
                                <button data-id="<?php echo $comments_reply->replyid ?>" data-news="<?php echo $news[0]['newsid'] ?>" class="delete-reply close"><span aria-hidden="true">&times;</span></button>
                            <?php
                        }
                    ?>
                    <h2><?php 
                    echo $comments_reply->reply_date;
                    ?></h2>  
                </div>
                <div class="col-lg-12">
                    <?php echo $comments_reply->reply_message ?>
                </div>
                <div class="col-lg-12"> 
                    <div class="float-right reply">
                        <span id="likereply-<?php echo $comments_reply->replyid ?>" class="likecomment"><?php echo count($comments_reply->liketotal) ?></span>
                        <span class="like-reply likecomment" data-id="<?php echo $comments_reply->replyid ?>" data-news="<?php echo $news[0]['newsid'] ?>"><i class="fa fa-angle-up"></i></span>
                        <span id="dislikereply-<?php echo $comments_reply->replyid ?>" class="likecomment"><?php echo count($comments_reply->disliketotal) ?></span>
                        <span class="dislike-reply likecomment" data-id="<?php echo $comments_reply->replyid ?>" data-news="<?php echo $news[0]['newsid'] ?>"><i class="fa fa-angle-down"></i></span>
                        <span class="likecomment"><i class="fa fa-circle"></i></span>
                        <p class="reply2Comment" data-id="reply-<?php echo $comments_reply->replyid ?>">Reply</p>  
                    </div>
                </div>
            </div>
            <div class="row third-comment" id="reply-<?php echo $comments_reply->replyid ?>" style="display:none">
                <div class="col-lg-12 no-padding-margin">
                    <form action="NewsController/insertReply" method="POST">
                        <input type="text" name="newsId" style="display:none;" value="<?php echo $news[0]['newsid'] ?>">
                        <input type="text" name="commentId" style="display:none;" value="<?php echo $comments->commentid ?>">
                        <div class="form-group">
                            <textarea class="form-control" id="text-<?php echo $comments_reply->replyid ?>" required name="replyComment" placeholder="masukkan komentar.." rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="float-right">
                                <input type="submit" class="btn btn-primary" value="submit"></input>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php
        }?>
        <?php
        }?>
    <?php
    }
    else
    {?>
        <?php foreach($comment as $comments)
        {?>
            <div class="row alert first-comment">
                <div class="col-lg-12">
                    <?php 
                        $email = $comments->email;
                        $cut = explode("@", $email);
                        $name = $cut[0];
                    ?>
                    <h1><?php echo $name ?></h1>
                    <h2><?php 
                    echo $comments->comment_date;
                    ?></h2>  
                </div>
                <div class="col-lg-12">
                    <?php echo $comments->comment_desc ?>
                </div>
            </div>
            <?php foreach($comments->replys as $comments_reply)
            {?>
                <div class="row alert second-comment">
                    <div class="col-lg-12">
                        <?php 
                            $email = $comments_reply->email;
                            $cut = explode("@", $email);
                            $name = $cut[0];
                        ?>
                        <h1><?php echo $name ?></h1>
                        <h2><?php 
                        echo $comments_reply->reply_date;
                        ?></h2>  
                    </div>
                    <div class="col-lg-12">
                        <?php echo $comments_reply->reply_message ?>
                    </div>
                </div>
            <?php
            }?>
        <?php
        }?>       
    <?php
    }?>
</div>
</body>
</html>