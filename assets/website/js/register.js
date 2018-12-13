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

    $("#parentTelepon").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    
    $("#akunKategori").change(function(){
        var kategori = $("#akunKategori").val();
        if(kategori == "user")
        {
            $("#user").show();
            $("#parents").hide();
        }
        else
        {
            $("#parents").show();
            $("#user").hide();
        }
    });

    $("#userDaftar").on('click',function(){
        $("#loading-screen").show();
        $("#loading-content").show();
        var kategori = $('#akunKategori').val();
        var email = $('#userEmail').val();
        var password = $('#userPassword').val();
        var name = $('#userNama').val();
        var telephone = $('#userTelepon').val();
        if(email == "" || password == "" || name == "" || telephone == "" || kategori == "0")
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
                url  : "UserController/register",
                dataType : "JSON",
                data : {
                    kategori: kategori,
                    email: email, 
                    password: password,
                    name:name,
                    telephone:telephone
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                },
                success: function(data){
                    if(data == "ERREG001")
                    {
                        $("#loading-screen").hide();
                        $("#loading-content").hide();
                        var html='';
                        html+='<div class="alert alert-warning" role="alert">Email sudah terdaftar..</div>';
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
                        html+='<div class="alert alert-success" role="alert">Data anda berhasil didaftarkan! aktivasi akun anda segera ..</div>';
                        $('#alert-content').html(html);
                        $('#alert-content').fadeIn(800);
                        setTimeout(function(){
                            $('#alert-content').fadeOut(2000);
                        },2000)

                        $('#akunKategori').val("0");
                        $('#userEmail').val("");
                        $('#userPassword').val("");
                        $('#userNama').val("");
                        $('#userTelepon').val("");

                        setTimeout(function(){
                            window.location.href = "home";
                        },3000)
                    }  
                }
            });
        }
    });

    $("#parentDaftar").on('click',function(){
        $("#loading-screen").show();
        $("#loading-content").show();
        var kategori = $('#akunKategori').val();
        var name = $("#parentNama").val();
        var email = $("#parentEmail").val();
        var telephone = $("#parentTelepon").val();
        var password = $("#parentPassword").val();
        var alamat = $("#parentAlamat").val();
        var kelamin = $('input[name=parentKelamin]:checked').val();
        var agama = $("#parentAgama").val();
        var lahir = $("#parentLahir").val();

        if(email == "" || password == "" || name == "" || telephone == "" || kategori == "0" || alamat == "" || agama == "0" || lahir == "")
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
                url  : "UserController/register",
                dataType : "JSON",
                data : {
                    kategori: kategori,
                    email: email, 
                    password: password,
                    name:name,
                    telephone:telephone,
                    alamat:alamat,
                    kelamin:kelamin,
                    agama:agama,
                    lahir:lahir
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                },
                success: function(data){
                    if(data == "ERREG001")
                    {
                        $("#loading-screen").hide();
                        $("#loading-content").hide();
                        var html='';
                        html+='<div class="alert alert-warning" role="alert">Email sudah terdaftar..</div>';
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
                        html+='<div class="alert alert-success" role="alert">Data anda berhasil didaftarkan! aktivasi akun anda segera ..</div>';
                        $('#alert-content').html(html);
                        $('#alert-content').fadeIn(800);
                        setTimeout(function(){
                            $('#alert-content').fadeOut(2000);
                        },2000)

                        $('#akunKategori').val("0");
                        $('#parentEmail').val("");
                        $('#parentPassword').val("");
                        $('#parentNama').val("");
                        $('#parentTelepon').val("");
                        $('#parentAlamat').val("");
                        $('#parentAgama').val("");
                        $('#parentLahir').val("");

                        setTimeout(function(){
                            window.location.href = "home";
                        },3000)
                    }  
                }
            });
        }
    });

});
    
