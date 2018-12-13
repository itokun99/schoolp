$( document ).ready(function() {
    var replyNav = "";
    var reply2Nav = "";

    $(".delete-comment").click(function(){
        var commentId = $(this).data('id');
        var newsId = $(this).data('news');
        var r = confirm("Apakah anda yakin menghapus komentar anda?");
        if (r == true) 
        {
            $.ajax
            ({
                type  : 'post',
                url   : 'NewsController/deleteComment',
                dataType : 'json',
                data : {
                    commentId:commentId,
                    newsId:newsId
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                },
                success : function (data)
                {
                    location.reload();
                }
            });
        } 
    });

    $(".delete-reply").click(function(){
        var replyId = $(this).data('id');
        var r = confirm("Apakah anda yakin menghapus komentar anda?");
        if (r == true) 
        {
            $.ajax
            ({
                type  : 'post',
                url   : 'NewsController/deleteReply',
                dataType : 'json',
                data : {
                    replyId:replyId
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                },
                success : function (data)
                {
                    location.reload();
                }
            });
        } 
    });

    $(".like-comment").click(function(){
        var commentId = $(this).data('id');
        var newsId = $(this).data('news');
        $.ajax
            ({
                type  : 'post',
                url   : 'NewsController/insertLikeComment',
                dataType : 'json',
                data : {
                    commentId:commentId,
                    newsId:newsId
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                },
                success : function (data)
                {
                    if(data == "ERLIK001")
                    {
                        
                    }
                    else
                    {
                        var totalLike = data.totalLike;
                        var totalDislike = data.totalDislike;
                        document.getElementById("likecomment-"+commentId).innerHTML = totalLike;
                        document.getElementById("dislikecomment-"+commentId).innerHTML = totalDislike;
                    }
                }
            });
    });

    $(".like-reply").click(function(){
        var replyId = $(this).data('id');
        var newsId = $(this).data('news');
        $.ajax
            ({
                type  : 'post',
                url   : 'NewsController/insertLikeReply',
                dataType : 'json',
                data : {
                    replyId:replyId,
                    newsId:newsId
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                },
                success : function (data)
                {
                    if(data == "ERLIK001")
                    {
                        
                    }
                    else
                    {
                        var totalLike = data.totalLike;
                        var totalDislike = data.totalDislike;
                        document.getElementById("likereply-"+replyId).innerHTML = totalLike;
                        document.getElementById("dislikereply-"+replyId).innerHTML = totalDislike;
                    }
                }
            });
    });

    $(".dislike-reply").click(function(){
        var replyId = $(this).data('id');
        var newsId = $(this).data('news');
        $.ajax
            ({
                type  : 'post',
                url   : 'NewsController/insertDislikeReply',
                dataType : 'json',
                data : {
                    replyId:replyId,
                    newsId:newsId
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                },
                success : function (data)
                {
                    if(data == "ERDIS001")
                    {
                        
                    }
                    else
                    {
                        var totalLike = data.totalLike;
                        var totalDislike = data.totalDislike;
                        document.getElementById("likereply-"+replyId).innerHTML = totalLike;
                        document.getElementById("dislikereply-"+replyId).innerHTML = totalDislike;
                    }
                }
            });
    });

    $(".dislike-comment").click(function(){
        var commentId = $(this).data('id');
        var newsId = $(this).data('news');
        $.ajax
            ({
                type  : 'post',
                url   : 'NewsController/insertDislikeComment',
                dataType : 'json',
                data : {
                    commentId:commentId,
                    newsId:newsId
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                },
                success : function (data)
                {
                    if(data == "ERDIS001")
                    {
                        
                    }
                    else
                    {
                        var totalLike = data.totalLike;
                        var totalDislike = data.totalDislike;
                        document.getElementById("likecomment-"+commentId).innerHTML = totalLike;
                        document.getElementById("dislikecomment-"+commentId).innerHTML = totalDislike;
                    }
                }
            });
    });

    $(".replyComment").click(function(){
        if(reply2Nav == ""){}else{$('#reply-'+ reply2Nav +'').hide();}
        if(replyNav == "")
        {
            var commentId = $(this).data('id');
            replyNav = commentId;
            $('#'+ commentId +'').show();
        }
        else
        {
            $('#'+ replyNav +'').hide();
            var commentId = $(this).data('id');
            replyNav = commentId;
            $('#'+ commentId +'').show();
        }
    });

    $(".reply2Comment").click(function(){
        if(replyNav == ""){}else{$('#'+ replyNav +'').hide();}
        var replyId = $(this).data('id');
        replyId = replyId.split("-");
        replyId = replyId[1];
        if(reply2Nav == "")
        {
            $.ajax
                ({
                    type  : 'get',
                    url   : 'NewsController/getReplyInformation',
                    dataType : 'json',
                    data : {
                        replyId:replyId
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    },
                    success : function(data)
                    {
                        var path = "text-"+replyId;
                        var email = data[0].email;
                        var nama = email.split("@");
                        var username = "@"+nama[0]+" ";
                        document.getElementById(path).innerHTML = username;
                        reply2Nav = replyId;
                        $('#reply-'+ replyId +'').show();
                    }
                });
        }
        else
        {
            $('#reply-'+ reply2Nav +'').hide();
            $.ajax
                ({
                    type  : 'get',
                    url   : 'NewsController/getReplyInformation',
                    dataType : 'json',
                    data : {
                        replyId:replyId
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    },
                    success : function(data)
                    {
                        var path = "text-"+replyId;
                        var email = data[0].email;
                        var nama = email.split("@");
                        var username = "@"+nama[0]+" ";
                        document.getElementById(path).innerHTML = username;
                        reply2Nav = replyId;
                        $('#reply-'+ replyId +'').show();
                    }
                });
        }
    });
});
    
