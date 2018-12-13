$( document ).ready(function() {
    $("#userTelepon").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
    
            reader.onload = function (e) {
                $('#userDisplayFoto').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#userFoto").change(function(){
        readURL(this);
    });

    $("#but-update").on('click',function(){
        var userFoto = $("#userFoto").val();
        var userNama = $("#userNama").val();
        var userEmail = $("#userEmail").val();
        var userTelepon = $("#userTelepon").val();
        if(userNama == "" || userTelepon == "")
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
            if(userFoto == "")
            {
                $.ajax({
                    type : "POST",
                    url  : "UserController/update",
                    dataType : "JSON",
                    data : {
                        userNama: userNama,
                        userTelepon: userTelepon
                    },
                    error: function() {
                        alert("error!");
                    },
                    success: function(data){      
                        var html='';
                        html+='<div class="alert alert-success" role="alert">Data anda telah diperbaharui..</div>';
                        $('#alert-content').html(html);
                        $('#alert-content').fadeIn(800);
                        setTimeout(function(){
                            $('#alert-content').fadeOut(2000);
                        },2000)
    
                        setTimeout(function(){
                            location.reload();
                        },3000)
                    }
                });
            }
            else
            {
                var data = new FormData();
                $.each($("#userFoto")[0].files,function(i,file){
                    data.append("userFoto",file);
                });
                $.ajax({
                    type : "POST",
                    url  : "UserController/upload",
                    processData : false,
                    dataType : "JSON",
                    data : data,
                    contentType : false,
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    },
                    success: function(data){
                        $.ajax({
                            type : "POST",
                            url  : "UserController/update",
                            dataType : "JSON",
                            data : {
                                userNama: userNama,
                                userTelepon: userTelepon
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            },
                            success: function(data){       
                                var html='';
                                html+='<div class="alert alert-success" role="alert">Data anda telah diperbaharui..</div>';
                                $('#alert-content').html(html);
                                $('#alert-content').fadeIn(800);
                                setTimeout(function(){
                                    $('#alert-content').fadeOut(2000);
                                },2000)
            
                                setTimeout(function(){
                                    location.reload();
                                },3000)
                            }
                        });
                    }
                });
            }
        }
    });
    
});
    
