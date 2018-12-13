$(window).ready(function() {
    setTimeout(function(){
		$('#loading-screen').fadeOut(1000);
    }, 3000);
    
    setTimeout(function(){
		$('#loading-content').fadeOut(1000);
	}, 2000);
});

function loginFb()
{
    FB.login(function(response){
        statusChangeCallback(response);
    }, {scope: 'public_profile,email'});
}

function loginNormal()
{
    var email = $('#userEmail').val();
    var password = $('#userPassword').val();
    var loginFrom = "normal";
    if(email == "" || password == "")
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
            url  : "UserController/login",
            dataType : "JSON",
            data : {
                loginEmail: email, 
                loginPassword:password,
                loginFrom:loginFrom
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            },
            success: function(data){
                if(data=="ERLOG001")
                {
                    var html='';
                    html+='<div class="alert alert-warning" role="alert">Email tidak terdaftar atau belum diverifikasi..</div>';
                    $('#alert-content').html(html);
                    $('#alert-content').fadeIn(800);
                    setTimeout(function(){
                        $('#alert-content').fadeOut(2000);
                    },2000)
                }
                else if(data=="ERLOG002")
                {
                    var html='';
                    html+='<div class="alert alert-warning" role="alert">Password yang anda masukkan salah..</div>';
                    $('#alert-content').html(html);
                    $('#alert-content').fadeIn(800);
                    setTimeout(function(){
                        $('#alert-content').fadeOut(2000);
                    },2000)
                }
                else if(data=="sukses")
                {
                    location.reload();
                }
            }
        });
    }  	
}

function userLogout(loginFrom)
{
    if(loginFrom == "normal")
    {
        $.ajax({
            type : "POST",
            url  : "UserController/logout",
            dataType : "JSON",
            error: function(xhr) {
                console.log(xhr.responseText);
            },
            success: function(data){
                window.location.href = "home";
            }
        });
    }
    else if(loginFrom == "facebook")
    {
        FB.getLoginStatus(function(response){
            if(response.status=="connected")
            {
                FB.logout(function(response){
                    if(response && !response.error)
                    {
                        $.ajax({
                            type : "POST",
                            url  : "UserController/logout",
                            dataType : "JSON",
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            },
                            success: function(data){
                                window.location.href = "home";
                            }
                        });
                    } 
                });   
            }
            else
            {
                window.location.href = "home";         
            }
        }, true);
    }
    else if(loginFrom == "gmail")
    {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
            $.ajax({
                type : "POST",
                url  : "UserController/logout",
                dataType : "JSON",
                error: function(xhr) {
                    console.log(xhr.responseText);
                },
                success: function(data){
                    window.location.href = "home";
                }
            });
        });
    }
}
$( document ).ready(function() {
    //Sticky Navbar
    loadGoogleApi();
    function loadGoogleApi(){
        gapi.load('auth2', function() {
            gapi.auth2.init();
        });
    }
    
    var loginSlideStatus = "off";
    var profileSlideStatus = "off";
    var whoSlideStatus = "off";

    $("#dropdown").click(function(e){
        if(whoSlideStatus == "off")
        {
            e.preventDefault();
            $('#dropdown-list-ul').slideDown('medium');
            $("#dropdown-icon").removeClass("fa-caret-down");
            $("#dropdown-icon").addClass("fa-caret-up");
            whoSlideStatus = "on";
        }
        else
        {
            e.preventDefault();
            $('#dropdown-list-ul').slideUp('medium');
            $("#dropdown-icon").removeClass("fa-caret-up");
            $("#dropdown-icon").addClass("fa-caret-down");
            whoSlideStatus = "off";
        }
    });

    $("#dropdown-login").click(function(e){
        if(loginSlideStatus == "off")
        {
            e.preventDefault();
            $('#dropdown-login-list').slideDown('medium');
            loginSlideStatus = "on";
        }
        else
        {
            e.preventDefault();
            $('#dropdown-login-list').slideUp('medium');
            loginSlideStatus = "off";
        }
    });

    $("#dropdown-profile").click(function(e){
        if(profileSlideStatus == "off")
        {
            e.preventDefault();
            $('#dropdown-profile-list').slideDown('medium');
            profileSlideStatus = "on";
        }
        else
        {
            e.preventDefault();
            $('#dropdown-profile-list').slideUp('medium');
            profileSlideStatus = "off";
        }
    });

    $("a").on('click', function(event) {
        if (this.hash !== "" && this.hash != "#slider-system") {
            event.preventDefault();
            var hash = this.hash;
          
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function(){
       
            window.location.hash = hash;
          });
        }
    });
});
