var googleUser = {};
var startApp = function() {
    gapi.load('auth2', function(){
      // Retrieve the singleton for the GoogleAuth library and set up the client.
    auth2 = gapi.auth2.init({
        client_id: '238640789322-n9969pmlmol4i605rlce32h0s7r2oofn.apps.googleusercontent.com',
        cookiepolicy: 'single_host_origin',
        // Request scopes in addition to 'profile' and 'email'
        //scope: 'additional_scope'
    });
    attachSignin(document.getElementById('customBtn'));
    });
};
startApp();
    
function attachSignin(element) {
    console.log(element.id);
    auth2.attachClickHandler(element, {},
    function(googleUser) { 
        var profile = googleUser.getBasicProfile();
        var loginEmail = profile.getEmail();
        var loginName = profile.getName();
        var loginFrom = "gmail";
            $.ajax({
                type : "POST",
                url  : "UserController/login",
                dataType : "JSON",
                data : {
                    loginEmail: loginEmail, 
                    loginName:loginName,
                    loginFrom:loginFrom
                },
                error: function() {
                    alert("error!");
                },
                success: function(data){
                    location.reload();
                }
            });
    });
  }

 