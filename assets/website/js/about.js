$( document ).ready(function() {
    goToSection();
    $('#why-we-doing-it').hide();
    $('#vision-and-mission').hide();
    $('#our-team').hide();
    $('#reason-box').hide();
    $('#reason-box-header').hide();
    $('#reason-box-paragraph').hide();
    $('#reason-box2').hide();
    $('#reason-box-header2').hide();
    $('#reason-box-paragraph2').hide();
    $('#reason-box3').hide();
    $('#reason-box-header3').hide();
    $('#reason-box-paragraph3').hide();
    $('#team').hide();
    
    function GetURLParameter(){
        var sPageURL = window.location.search.substring(1);
        var sSection = sPageURL.split('=');
        return sSection[1];
    }

    function goToSection(){
        var section = GetURLParameter();
        if(section == 1)
        {
            var hash = '#section-top';  
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function(){
            window.location.hash = hash;
            });
        }
        else if(section == 2)
        {
            var hash = '#section-vm';  
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function(){
            window.location.hash = hash;
            });
        }
        else if(section == 3)
        {
            var hash = '#section-our-team';  
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function(){
            window.location.hash = hash;
            });
        }
        else
        {

        }
    }

    $("#dot-1").hover(
        function (){
            $('#why-we-doing-it').fadeIn(500);
        },
        function (){
            $('#why-we-doing-it').fadeOut(500);
        }
    );

    $("#dot-2").hover(
        function (){
            $('#vision-and-mission').fadeIn(500);
        },
        function (){
            $('#vision-and-mission').fadeOut(500);
        }
    );

    $("#dot-3").hover(
        function (){
            $('#our-team').fadeIn(500);
        },
        function (){
            $('#our-team').fadeOut(500);
        }
    );

    $('#data-counter').waypoint(function(direction) {
        setTimeout(function(){
           counter();
        }, 3000);
        this.destroy()
		}, {
        offset: '100%'
    });

    $('#section-reason').waypoint(function(direction) {
        $('#reason-box').addClass("reason-box");
        $('#reason-box').show();
        setTimeout(function(){
            $('#reason-box-header').addClass("reason-box-header");
            $('#reason-box-header').show();
        }, 1000);
        setTimeout(function(){
            $('#reason-box-paragraph').addClass("reason-box-paragraph");
            $('#reason-box-paragraph').show();
        }, 1300);
        this.destroy()
		}, {
        offset: '100%'
    });

    $('#section-reason2').waypoint(function(direction) {
        $('#reason-box2').addClass("reason-box2");
        $('#reason-box2').show();
        setTimeout(function(){
            $('#reason-box-header2').addClass("reason-box-header2");
            $('#reason-box-header2').show();
        }, 1000);
        setTimeout(function(){
            $('#reason-box-paragraph2').addClass("reason-box-paragraph2");
            $('#reason-box-paragraph2').show();
        }, 1300);
        this.destroy()
		}, {
        offset: '100%'
    });

    $('#section-reason3').waypoint(function(direction) {
        $('#reason-box3').addClass("reason-box3");
        $('#reason-box3').show();
        setTimeout(function(){
            $('#reason-box-header3').addClass("reason-box-header3");
            $('#reason-box-header3').show();
        }, 1000);
        setTimeout(function(){
            $('#reason-box-paragraph3').addClass("reason-box-paragraph3");
            $('#reason-box-paragraph3').show();
        }, 1300);
        this.destroy()
		}, {
        offset: '100%'
    });

    $('#section-our-team').waypoint(function(direction) {
        $("#team").addClass("team");
        $('#team').show();
        this.destroy()  
		}, {
        offset: '100%'
    });
    
    $('#section-vm').waypoint(function(direction) {
        if(direction == "down")
        {
            $("#go-up").fadeIn(1000);
        }
        else
        {
            $("#go-up").fadeOut(1000);
        }
    }, {
    offset: '100%'
    });
    
    function counter(){
        $('.count').each(function () {
            $(this).prop('Counter',0).animate({
                Counter: $(this).text()
            }, {
                duration: 3000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });
    };
});
    
