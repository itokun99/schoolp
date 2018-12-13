window.fbAsyncInit = function() {
    FB.init({
      appId      : '1955989994447935',
      cookie     : true,
      xfbml      : true,
      version    : 'v3.1'
    }); 

    FB.getLoginStatus(function(response){
        if(response.status=="connected")
        {
            
        }
        else
        {
            $.ajax({
                type : "POST",
                url  : "UserController/logout",
                dataType : "JSON",
                error: function() {
                    
                },
                success: function(data){
                    location.reload();
                }
            });
        }
    });

  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

   function statusChangeCallback(response){
        if(response.status === "connected")
        {
            checkUserData();
        }
   }

   function checkUserData(){
        FB.api('/me?fields=name,email', function(response){
            if(response && !response.error)
            {
                var email = response.email;
                var name = response.name;
                var loginFrom = "facebook";
                $.ajax({
                    type : "POST",
                    url  : "UserController/login",
                    dataType : "JSON",
                    data : {
                        loginEmail: email, 
                        loginName:name,
                        loginFrom:loginFrom
                    },
                    error: function() {
                        alert("error!");
                    },
                    success: function(data){
                        location.reload();
                    }
                });
            }
        })
   }
    
