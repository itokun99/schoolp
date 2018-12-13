$( document ).ready(function() {

    $("#contactTelepon").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    $("#sendMessage").on('click',function(){
        var contactEmail = $('#contactEmail').val();
        var contactNama = $('#contactNama').val();
        var contactTelepon = $('#contactTelepon').val();
        var contactPesan = $('#contactPesan').val();
        if(contactEmail == "" || contactNama == "" || contactTelepon == "" || contactPesan == "0")
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
                url  : "UserController/sendMessage",
                dataType : "JSON",
                data : {
                    contactEmail: contactEmail,
                    contactNama: contactNama, 
                    contactTelepon: contactTelepon,
                    contactPesan:contactPesan
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                },
                success: function(data){
                    var html='';
                    html+='<div class="alert alert-success" role="alert">Terima kasih! kami akan menjawab pertanyaan anda dalam waktu dekat..</div>';
                    $('#alert-content').html(html);
                    $('#alert-content').fadeIn(800);
                    setTimeout(function(){
                        $('#alert-content').fadeOut(2000);
                    },2000)

                    $('#contactEmail').val("");
                    $('#contactNama').val("");
                    $('#contactTelepon').val("");
                    $('#contactPesan').val("");

                    setTimeout(function(){
                        window.location.href = "home";
                    },3000)
                }
            });
        }
    });

});
    
