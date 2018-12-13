$( document ).ready(function() {
    goToSection();
    $("#tab-student").hide();
    $("#tab-school").hide();
    $("#pfeature-list").hide();
    $("#pfeature-list2").hide();
    $("#pfeature-list3").hide();
    $("#pfeature-list4").hide();
    $("#technology-box").hide();
    $("#technology-box-header").hide();
    $("#technology-box-paragraph").hide();
    $("#technology-box2").hide();
    $("#technology-box-header2").hide();
    $("#technology-box-paragraph2").hide();
    $("#technology-box3").hide();
    $("#technology-box-header3").hide();
    $("#technology-box-paragraph3").hide();

    function GetURLParameter(){
        var sPageURL = window.location.search.substring(1);
        var sSection = sPageURL.split('=');
        return sSection[1];
    }

    function goToSection(){
        var section = GetURLParameter();
        if(section == 1)
        {
            var hash = '#section-problem';  
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function(){
            window.location.hash = hash;
            });
        }
        else if(section == 2)
        {
            var hash = '#section-gadget-feature';  
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function(){
            window.location.hash = hash;
            });
        }
        else if(section == 3)
        {
            var hash = '#section-technology';  
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

    $('#section-phone-feature').waypoint(function() {
        $("#pfeature-list").addClass("pfeature-list");
        $("#pfeature-list").show();
        setTimeout(function(){
            $("#pfeature-list2").addClass("pfeature-list2");
            $("#pfeature-list2").show();
        },200);
        setTimeout(function(){
            $("#pfeature-list3").addClass("pfeature-list4");
            $("#pfeature-list3").show();
        },400);
        setTimeout(function(){
            $("#pfeature-list4").addClass("pfeature-list4");
            $("#pfeature-list4").show();
        },600);
        this.destroy() 
		}, {
        offset: '75%'
    });

    $('#section-technology').waypoint(function(direction) {
        $('#technology-box').addClass("technology-box");
        $('#technology-box').show();
        setTimeout(function(){
            $('#technology-box-header').addClass("technology-box-header");
            $('#technology-box-header').show();
        }, 1000);
        setTimeout(function(){
            $('#technology-box-paragraph').addClass("technology-box-paragraph");
            $('#technology-box-paragraph').show();
        }, 1300);
        this.destroy()
		}, {
        offset: '100%'
    });

    $('#section-technology2').waypoint(function(direction) {
        $('#technology-box2').addClass("technology-box2");
        $('#technology-box2').show();
        setTimeout(function(){
            $('#technology-box-header2').addClass("technology-box-header2");
            $('#technology-box-header2').show();
        }, 1000);
        setTimeout(function(){
            $('#technology-box-paragraph2').addClass("technology-box-paragraph2");
            $('#technology-box-paragraph2').show();
        }, 1300);
        this.destroy()
		}, {
        offset: '100%'
    });

    $('#section-technology3').waypoint(function(direction) {
        $('#technology-box3').addClass("technology-box3");
        $('#technology-box3').show();
        setTimeout(function(){
            $('#technology-box-header3').addClass("technology-box-header3");
            $('#technology-box-header3').show();
        }, 1000);
        setTimeout(function(){
            $('#technology-box-paragraph3').addClass("technology-box-paragraph3");
            $('#technology-box-paragraph3').show();
        }, 1300);
        this.destroy()
		}, {
        offset: '100%'
    });

    $('#but-student').on('click',function(){
        $("#tab-school").hide();
        $("#tab-parent").hide();
        $("#tab-student").show();
        $("#but-parent").removeClass("problem-tab-active");
        $("#but-school").removeClass("problem-tab-active");
        $("#but-student").addClass("problem-tab-active");
    });

    $('#but-parent').on('click',function(){
        $("#tab-school").hide();
        $("#tab-parent").show();
        $("#tab-student").hide();
        $("#but-parent").addClass("problem-tab-active");
        $("#but-school").removeClass("problem-tab-active");
        $("#but-student").removeClass("problem-tab-active");
    });

    $('#but-school').on('click',function(){
        $("#tab-school").show();
        $("#tab-parent").hide();
        $("#tab-student").hide();
        $("#but-parent").removeClass("problem-tab-active");
        $("#but-school").addClass("problem-tab-active");
        $("#but-student").removeClass("problem-tab-active");
    });

    $('#vm').waypoint(function(direction) {
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
});
    
