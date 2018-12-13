$( document ).ready(function() {
    $("#kategoriHubungan").change(function(){
        var kategoriHubungan = $("#kategoriHubungan").val();
        if(kategoriHubungan == "Wali")
        {
            $("#waliHubungan").show();
        }
        else
        {
            $("#waliHubungan").hide();
        }
    });

    $("#parentUpgrade").on('click',function(){
        var kategoriHubungan = $("#kategoriHubungan").val();
        var alamat = $("#parentAlamat").val();
        var agama = $("#parentAgama").val();
        var lahir = $("#parentLahir").val();
        if(kategoriHubungan == "Wali")
        {
            var kelamin = $('input[name=waliKelamin]:checked').val();
            if(kategoriHubungan == "0" || lahir == "" || agama == "" || alamat == "" || kelamin == "")
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
                    url  : "UserController/update_parent",
                    dataType : "JSON",
                    data : {
                        kategoriHubungan: kategoriHubungan,
                        alamat:alamat,
                        agama:agama,
                        kelamin:kelamin,
                        lahir:lahir
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    },
                    success: function(data){
                        var html='';
                        html+='<div class="alert alert-success" role="alert">Anda telah menjadi orang tua! anda akan dipindahkan ke panel orang tua ..</div>';
                        $('#alert-content').html(html);
                        $('#alert-content').fadeIn(800);
                        setTimeout(function(){
                            $('#alert-content').fadeOut(2000);
                        },2000)

                        setTimeout(function(){
                            window.location.href = "login/signin";
                        },3000)
                    }
                });
            }
        }
        else
        {
            if(kategoriHubungan == "0" || lahir == "" || agama == "" || alamat == "")
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
                    url  : "UserController/update_parent",
                    dataType : "JSON",
                    data : {
                        kategoriHubungan: kategoriHubungan,
                        alamat:alamat,
                        agama:agama,
                        lahir:lahir
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    },
                    success: function(data){
                        var html='';
                        html+='<div class="alert alert-success" role="alert">Anda telah menjadi orang tua! anda akan dipindahkan ke panel orang tua ..</div>';
                        $('#alert-content').html(html);
                        $('#alert-content').fadeIn(800);
                        setTimeout(function(){
                            $('#alert-content').fadeOut(2000);
                        },2000)

                        setTimeout(function(){
                            window.location.href = "login/signin";
                        },3000)
                    }
                });
            }
        }  
    });
});
    
