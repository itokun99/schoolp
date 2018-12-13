$( document ).ready(function() {
    $('#point').hide();
    $('#point2').hide();
    $('#point3').hide();
    $('#point4').hide();
    $('#objective-box-left-1').hide();
    $('#objective-box-left-2').hide();
    $('#objective-box-right-1').hide();
    $('#objective-box-right-2').hide();
    $('#welcome-image').hide();

    $('#but_search').on('click',function(){
        $("#loading-screen").show();
        $("#loading-content").show();
        var tingkatSearch = $('#tingkatSearch').val();
        var tingkatProvinsi = $('#tingkatProvinsi').val();
        var tingkatKabupaten = $('#tingkatKabupaten').val();
        var tingkatKecamatan = $('#tingkatKecamatan').val();
        var tingkatNamaSekolah = $('#tingkatNamaSekolah').val();

        if(tingkatSearch != "" && tingkatProvinsi == "" && tingkatKabupaten == "" && tingkatKecamatan == "" && tingkatNamaSekolah == "")
        {
            $("#loading-screen").hide();
            $("#loading-content").hide();
            var html='';
            html+='<div class="alert alert-warning" role="alert">Pilih provinsi..</div>';
            $('#alert-content').html(html);
            $('#alert-content').fadeIn(800);
            setTimeout(function(){
                $('#alert-content').fadeOut(2000);
            },2000)
        }
        else if(tingkatSearch != "" && tingkatProvinsi == "" && tingkatKabupaten == "" && tingkatKecamatan == "" && tingkatNamaSekolah != "")
        {
            $.ajax
                ({
                type  : 'get',
                url   : 'UserController/getSekolahTingkatWithName',
                dataType : 'json',
                data : {
                    tingkatSearch:tingkatSearch,
                    tingkatNamaSekolah:tingkatNamaSekolah
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                },
                success : function(data)
                {
                    if(data == "ERSEANOF")
                    {
                        $("#loading-screen").hide();
                        $("#loading-content").hide();
                        var html='';
                        html+='<div class="alert alert-warning" role="alert">Tidak ada data sekolah yang terdaftar pada daerah tersebut..</div>';
                        $('#alert-content').html(html);
                        $('#alert-content').fadeIn(800);
                        setTimeout(function(){
                            $('#alert-content').fadeOut(2000);
                        },2000)
                    }
                    else
                    {
                        window.location.href = "maps";
                        $('#tingkatSearch').val("");
                        $('#tingkatProvinsi').val("");
                        $('#tingkatKabupaten').val("");
                        $('#tingkatKecamatan').val("");
                        $('#tingkatNamaSekolah').val("");
                    }
                }
            });
        }
        else if(tingkatSearch != "" && tingkatProvinsi != "" && tingkatKabupaten == "" && tingkatKecamatan == "" && tingkatNamaSekolah == "")
        {
            $.ajax
                ({
                type  : 'get',
                url   : 'UserController/getSekolahProvinsi',
                dataType : 'json',
                data : {
                    tingkatSearch:tingkatSearch,
                    tingkatProvinsi:tingkatProvinsi
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                },
                success : function(data)
                {
                    if(data == "ERSEA001")
                    {
                        $("#loading-screen").hide();
                        $("#loading-content").hide();
                        var html='';
                        html+='<div class="alert alert-warning" role="alert">Data provinsi tidak terdaftar, pilihlah dari daftar yang tersedia..</div>';
                        $('#alert-content').html(html);
                        $('#alert-content').fadeIn(800);
                        setTimeout(function(){
                            $('#alert-content').fadeOut(2000);
                        },2000)
                    }
                    else if(data == "ERSEANOF")
                    {
                        $("#loading-screen").hide();
                        $("#loading-content").hide();
                        var html='';
                        html+='<div class="alert alert-warning" role="alert">Tidak ada data sekolah yang terdaftar pada daerah tersebut..</div>';
                        $('#alert-content').html(html);
                        $('#alert-content').fadeIn(800);
                        setTimeout(function(){
                            $('#alert-content').fadeOut(2000);
                        },2000)
                    }
                    else
                    {
                        window.location.href = "maps";
                        $('#tingkatSearch').val("");
                        $('#tingkatProvinsi').val("");
                        $('#tingkatKabupaten').val("");
                        $('#tingkatKecamatan').val("");
                        $('#tingkatNamaSekolah').val("");
                    }
                }
            });
        }
        else if(tingkatSearch != "" && tingkatProvinsi != "" && tingkatKabupaten == "" && tingkatKecamatan == "" && tingkatNamaSekolah != "")
        {
            $.ajax
                ({
                type  : 'get',
                url   : 'UserController/getSekolahProvinsiWithName',
                dataType : 'json',
                data : {
                    tingkatSearch:tingkatSearch,
                    tingkatProvinsi:tingkatProvinsi,
                    tingkatNamaSekolah:tingkatNamaSekolah
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                },
                success : function(data)
                {
                    if(data == "ERSEA001")
                    {
                        $("#loading-screen").hide();
                        $("#loading-content").hide();
                        var html='';
                        html+='<div class="alert alert-warning" role="alert">Data provinsi tidak terdaftar, pilihlah dari daftar yang tersedia..</div>';
                        $('#alert-content').html(html);
                        $('#alert-content').fadeIn(800);
                        setTimeout(function(){
                            $('#alert-content').fadeOut(2000);
                        },2000)
                    }
                    else if(data == "ERSEANOF")
                    {
                        $("#loading-screen").hide();
                        $("#loading-content").hide();
                        var html='';
                        html+='<div class="alert alert-warning" role="alert">Tidak ada data sekolah yang terdaftar pada daerah tersebut..</div>';
                        $('#alert-content').html(html);
                        $('#alert-content').fadeIn(800);
                        setTimeout(function(){
                            $('#alert-content').fadeOut(2000);
                        },2000)
                    }
                    else
                    {
                        window.location.href = "maps";
                        $('#tingkatSearch').val("");
                        $('#tingkatProvinsi').val("");
                        $('#tingkatKabupaten').val("");
                        $('#tingkatKecamatan').val("");
                        $('#tingkatNamaSekolah').val("");
                    }
                }
            });
        }
        else if(tingkatSearch != "" && tingkatProvinsi != "" && tingkatKabupaten != "" && tingkatKecamatan == "" && tingkatNamaSekolah == "")
        {
            $.ajax
                ({
                type  : 'get',
                url   : 'UserController/getSekolahKabupaten',
                dataType : 'json',
                data : {
                    tingkatSearch:tingkatSearch,
                    tingkatProvinsi:tingkatProvinsi,
                    tingkatKabupaten:tingkatKabupaten
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                },
                success : function(data)
                {
                    if(data == "ERSEA001")
                    {
                        $("#loading-screen").hide();
                        $("#loading-content").hide();
                        var html='';
                        html+='<div class="alert alert-warning" role="alert">Data provinsi tidak terdaftar, pilihlah dari daftar yang tersedia..</div>';
                        $('#alert-content').html(html);
                        $('#alert-content').fadeIn(800);
                        setTimeout(function(){
                            $('#alert-content').fadeOut(2000);
                        },2000)
                    }
                    else if(data == "ERSEA002")
                    {
                        $("#loading-screen").hide();
                        $("#loading-content").hide();
                        var html='';
                        html+='<div class="alert alert-warning" role="alert">Data kabupaten tidak terdaftar, pilihlah dari daftar yang tersedia..</div>';
                        $('#alert-content').html(html);
                        $('#alert-content').fadeIn(800);
                        setTimeout(function(){
                            $('#alert-content').fadeOut(2000);
                        },2000)
                    }
                    else if(data == "ERSEANOF")
                    {
                        $("#loading-screen").hide();
                        $("#loading-content").hide();
                        var html='';
                        html+='<div class="alert alert-warning" role="alert">Tidak ada data sekolah yang terdaftar pada daerah tersebut..</div>';
                        $('#alert-content').html(html);
                        $('#alert-content').fadeIn(800);
                        setTimeout(function(){
                            $('#alert-content').fadeOut(2000);
                        },2000)
                    }
                    else
                    {
                        window.location.href = "maps";
                        $('#tingkatSearch').val("");
                        $('#tingkatProvinsi').val("");
                        $('#tingkatKabupaten').val("");
                        $('#tingkatKecamatan').val("");
                        $('#tingkatNamaSekolah').val("");
                    }
                }
            });
        }
        else if(tingkatSearch != "" && tingkatProvinsi != "" && tingkatKabupaten != "" && tingkatKecamatan == "" && tingkatNamaSekolah != "")
        {
            $.ajax
                ({
                type  : 'get',
                url   : 'UserController/getSekolahKabupatenWithName',
                dataType : 'json',
                data : {
                    tingkatSearch:tingkatSearch,
                    tingkatProvinsi:tingkatProvinsi,
                    tingkatKabupaten:tingkatKabupaten,
                    tingkatNamaSekolah:tingkatNamaSekolah
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                },
                success : function(data)
                {
                    if(data == "ERSEA001")
                    {
                        $("#loading-screen").hide();
                        $("#loading-content").hide();
                        var html='';
                        html+='<div class="alert alert-warning" role="alert">Data provinsi tidak terdaftar, pilihlah dari daftar yang tersedia..</div>';
                        $('#alert-content').html(html);
                        $('#alert-content').fadeIn(800);
                        setTimeout(function(){
                            $('#alert-content').fadeOut(2000);
                        },2000)
                    }
                    else if(data == "ERSEA002")
                    {
                        $("#loading-screen").hide();
                        $("#loading-content").hide();
                        var html='';
                        html+='<div class="alert alert-warning" role="alert">Data kabupaten tidak terdaftar, pilihlah dari daftar yang tersedia..</div>';
                        $('#alert-content').html(html);
                        $('#alert-content').fadeIn(800);
                        setTimeout(function(){
                            $('#alert-content').fadeOut(2000);
                        },2000)
                    }
                    else if(data == "ERSEANOF")
                    {
                        $("#loading-screen").hide();
                        $("#loading-content").hide();
                        var html='';
                        html+='<div class="alert alert-warning" role="alert">Tidak ada data sekolah yang terdaftar pada daerah tersebut..</div>';
                        $('#alert-content').html(html);
                        $('#alert-content').fadeIn(800);
                        setTimeout(function(){
                            $('#alert-content').fadeOut(2000);
                        },2000)
                    }
                    else
                    {
                        window.location.href = "maps";
                        $('#tingkatSearch').val("");
                        $('#tingkatProvinsi').val("");
                        $('#tingkatKabupaten').val("");
                        $('#tingkatKecamatan').val("");
                        $('#tingkatNamaSekolah').val("");
                    }
                }
            });
        }
        else if(tingkatSearch != "" && tingkatProvinsi != "" && tingkatKabupaten != "" && tingkatKecamatan != "")
        {
            if(tingkatNamaSekolah == "")
            {
                $.ajax
                ({
                    type  : 'get',
                    url   : 'UserController/getSekolahKecamatan',
                    dataType : 'json',
                    data : {
                        tingkatSearch:tingkatSearch,
                        tingkatProvinsi:tingkatProvinsi,
                        tingkatKabupaten:tingkatKabupaten,
                        tingkatKecamatan:tingkatKecamatan
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    },
                    success : function(data)
                    {
                       if(data == "ERSEA001")
                       {
                            $("#loading-screen").hide();
                            $("#loading-content").hide();
                            var html='';
                            html+='<div class="alert alert-warning" role="alert">Data provinsi tidak terdaftar, pilihlah dari daftar yang tersedia..</div>';
                            $('#alert-content').html(html);
                            $('#alert-content').fadeIn(800);
                            setTimeout(function(){
                                $('#alert-content').fadeOut(2000);
                            },2000)
                        }
                        else if(data == "ERSEA002")
                        {
                            $("#loading-screen").hide();
                            $("#loading-content").hide();
                            var html='';
                            html+='<div class="alert alert-warning" role="alert">Data kabupaten tidak terdaftar, pilihlah dari daftar yang tersedia..</div>';
                            $('#alert-content').html(html);
                            $('#alert-content').fadeIn(800);
                            setTimeout(function(){
                                $('#alert-content').fadeOut(2000);
                            },2000)
                        }
                        else if(data == "ERSEA003")
                        {
                            $("#loading-screen").hide();
                            $("#loading-content").hide();
                            var html='';
                            html+='<div class="alert alert-warning" role="alert">Data kecamatan tidak terdaftar, pilihlah dari daftar yang tersedia..</div>';
                            $('#alert-content').html(html);
                            $('#alert-content').fadeIn(800);
                            setTimeout(function(){
                                $('#alert-content').fadeOut(2000);
                            },2000)
                        }
                        else if(data == "ERSEANOF")
                        {
                            $("#loading-screen").hide();
                            $("#loading-content").hide();
                            var html='';
                            html+='<div class="alert alert-warning" role="alert">Tidak ada data sekolah yang terdaftar pada daerah tersebut..</div>';
                            $('#alert-content').html(html);
                            $('#alert-content').fadeIn(800);
                            setTimeout(function(){
                                $('#alert-content').fadeOut(2000);
                            },2000)
                        }
                        else
                        {
                            window.location.href = "maps";
                            $('#tingkatSearch').val("");
                            $('#tingkatProvinsi').val("");
                            $('#tingkatKabupaten').val("");
                            $('#tingkatKecamatan').val("");
                            $('#tingkatNamaSekolah').val("");
                        }
                    }
                });
            }
            else
            {
                $.ajax
                ({
                    type  : 'get',
                    url   : 'UserController/getSekolahWithName',
                    dataType : 'json',
                    data : {
                        tingkatSearch:tingkatSearch,
                        tingkatProvinsi:tingkatProvinsi,
                        tingkatKabupaten:tingkatKabupaten,
                        tingkatKecamatan:tingkatKecamatan,
                        tingkatNamaSekolah:tingkatNamaSekolah
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    },
                    success : function(data)
                    {
                       if(data == "ERSEA001")
                       {
                            $("#loading-screen").hide();
                            $("#loading-content").hide();
                            var html='';
                            html+='<div class="alert alert-warning" role="alert">Data provinsi tidak terdaftar, pilihlah dari daftar yang tersedia..</div>';
                            $('#alert-content').html(html);
                            $('#alert-content').fadeIn(800);
                            setTimeout(function(){
                                $('#alert-content').fadeOut(2000);
                            },2000)
                        }
                        else if(data == "ERSEA002")
                        {
                            $("#loading-screen").hide();
                            $("#loading-content").hide();
                            var html='';
                            html+='<div class="alert alert-warning" role="alert">Data kabupaten tidak terdaftar, pilihlah dari daftar yang tersedia..</div>';
                            $('#alert-content').html(html);
                            $('#alert-content').fadeIn(800);
                            setTimeout(function(){
                                $('#alert-content').fadeOut(2000);
                            },2000)
                        }
                        else if(data == "ERSEA003")
                        {
                            $("#loading-screen").hide();
                            $("#loading-content").hide();
                            var html='';
                            html+='<div class="alert alert-warning" role="alert">Data kecamatan tidak terdaftar, pilihlah dari daftar yang tersedia..</div>';
                            $('#alert-content').html(html);
                            $('#alert-content').fadeIn(800);
                            setTimeout(function(){
                                $('#alert-content').fadeOut(2000);
                            },2000)
                        }
                        else if(data == "ERSEA004")
                        {
                            $("#loading-screen").hide();
                            $("#loading-content").hide();
                            var html='';
                            html+='<div class="alert alert-warning" role="alert">Tidak ada data sekolah yang terdaftar pada daerah tersebut..</div>';
                            $('#alert-content').html(html);
                            $('#alert-content').fadeIn(800);
                            setTimeout(function(){
                                $('#alert-content').fadeOut(2000);
                            },2000)
                        }
                        else if(data == "ERSEANOF")
                        {
                            $("#loading-screen").hide();
                            $("#loading-content").hide();
                            var html='';
                            html+='<div class="alert alert-warning" role="alert">Jenjang pendidikan yang dicari tidak ada pada sekolah tersebut..</div>';
                            $('#alert-content').html(html);
                            $('#alert-content').fadeIn(800);
                            setTimeout(function(){
                                $('#alert-content').fadeOut(2000);
                            },2000)
                        }
                        else
                        {
                            window.location.href = "maps";
                            $('#tingkatSearch').val("");
                            $('#tingkatProvinsi').val("");
                            $('#tingkatKabupaten').val("");
                            $('#tingkatKecamatan').val("");
                            $('#tingkatNamaSekolah').val("");
                        }
                    }
                });
            }
        }
    });

    $('#objective-place-1').waypoint(function() {
        $("#point").addClass("point");
        $('#point').show();
        $("#objective-box-left-1").addClass("objective-box-left");
        $('#objective-box-left-1').show();
        this.destroy() 
		}, {
        offset: '100%'
    });

    $('#section-welcome').waypoint(function() {
        $("#welcome-image").addClass("welcome-image");
        $('#welcome-image').show();
        this.destroy() 
		}, {
        offset: '100%'
    });

    $('#parallax-header').waypoint(function() {
        $("#parallax-mendikbud").addClass("fadeInRight");
        $("#parallax-metrodata").addClass("fadeInLeft");
        $("#parallax-header").addClass("fadeInDown");
        this.destroy() 
		}, {
        offset: '100%'
    });

    $('#objective-place-2').waypoint(function() {
        $("#point2").addClass("point2");
        $('#point2').show();
        $("#objective-box-right-1").addClass("objective-box-right");
        $('#objective-box-right-1').show();
        this.destroy() 
		}, {
        offset: '100%'
    });

    $('#objective-place-3').waypoint(function() {
        $("#point3").addClass("point3");
        $('#point3').show();
        $("#objective-box-left-2").addClass("objective-box-left");
        $('#objective-box-left-2').show();
        this.destroy() 
		}, {
        offset: '100%'
    });

    $('#objective-place-4').waypoint(function() {
        $("#point4").addClass("point4");
        $('#point4').show();
        $("#objective-box-right-2").addClass("objective-box-right");
        $('#objective-box-right-2').show();
        this.destroy() 
		}, {
        offset: '100%'
    });

    $('#parallax').waypoint(function(direction) {
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

    $('#fb-login').on('click', function(){
        FB.login(statusChangeCallback, {scope: 'email,public_profile', return_scopes: true});
    });
});
