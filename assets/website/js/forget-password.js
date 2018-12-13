$( document ).ready(function() {
    checkMobile();

    function checkMobile(){
        var emailMobile = $('#emailMobile').val();
        if(emailMobile!=""){
            $.ajax({
                type : "POST",
                url  : "UserController/forget_decrypt",
                dataType : "JSON",
                data : {
                    emailMobile: emailMobile
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                },
                success: function(data){
                    $('#emailMobile').val(data);
                }
            });
        }
    }

    $("#getPassword").on('click',function(){
        $("#loading-screen").show();
        $("#loading-content").show();
        var forgetEmail = $("#forgetEmail").val();
        if(forgetEmail == "")
        {
            var html='';
            html+='<div class="alert alert-danger" role="alert">Lengkapi informasi yang dibutuhkan..</div>';
            $('#alert-content').html(html);
            $('#alert-content').fadeIn(800);
            setTimeout(function(){
                $('#alert-content').fadeOut(2000);
            },2000)
        }   
        else
        {
            $.ajax({
                type : "POST",
                url  : "UserController/forget",
                dataType : "JSON",
                data : {
                    forgetEmail: forgetEmail
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                },
                success: function(data){
                    if(data == "ERRES001")
                    {
                        $("#loading-screen").hide();
                        $("#loading-content").hide();
                        var html='';
                        html+='<div class="alert alert-danger" role="alert">Email tidak terdaftar..</div>';
                        $('#alert-content').html(html);
                        $('#alert-content').fadeIn(800);
                        setTimeout(function(){
                            $('#alert-content').fadeOut(2000);
                        },2000)
                    }
                    else
                    {
                        $("#loading-screen").hide();
                        $("#loading-content").hide();
                        var html='';
                        html+='<div class="alert alert-success" role="alert">Link pengaturan ulang kata sandi telah dikirim ke email anda..</div>';
                        $('#alert-content').html(html);
                        $('#alert-content').fadeIn(800);
                        setTimeout(function(){
                            $('#alert-content').fadeOut(2000);
                        },2000)

                        setTimeout(function(){
                            window.location.href = "home";
                        },3000)
                    }
                }
            });
        } 
    });

    $("#setPassword").on('click',function(){
        var emailMobile = $("#emailMobile").val();
        var newPassword = $("#newPassword").val();
        var newPasswordVerify = $("#newPasswordVerify").val();
        if(newPassword == "" || newPasswordVerify == "")
        {
            var html='';
            html+='<div class="alert alert-danger" role="alert">Lengkapi informasi yang dibutuhkan..</div>';
            $('#alert-content').html(html);
            $('#alert-content').fadeIn(800);
            setTimeout(function(){
                $('#alert-content').fadeOut(2000);
            },2000)
        }  
        else if(newPassword != newPasswordVerify)
        {
            var html='';
            html+='<div class="alert alert-danger" role="alert">Kata sandi baru dengan kata sandi verifikasi tidak sama..</div>';
            $('#alert-content').html(html);
            $('#alert-content').fadeIn(800);
            setTimeout(function(){
                $('#alert-content').fadeOut(2000);
            },2000)
        } 
        else
        {
            $.ajax({
                type : "POST",
                url  : "UserController/set_new_password",
                dataType : "JSON",
                data : {
                    newPassword: newPassword,
                    newPasswordVerify: newPasswordVerify,
                    emailMobile:emailMobile
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                },
                success: function(data){
                    var html='';
                    html+='<div class="alert alert-success" role="alert">Kata sandi anda berhasil diubah..</div>';
                    $('#alert-content').html(html);
                    $('#alert-content').fadeIn(800);
                    setTimeout(function(){
                        $('#alert-content').fadeOut(2000);
                    },2000)

                    setTimeout(function(){
                        window.location.href = "home";
                    },3000)
                }
            });
        } 
    });

});
    
