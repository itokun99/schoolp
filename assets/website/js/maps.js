$( document ).ready(function() {
    sekolahData();
    fillProvinsi();

    function InitializeMap(data,searchby) {
        if(searchby == "provinsi"){
            var zoomrange = 12;
        }
        else if(searchby == "kabupaten"){
            var zoomrange = 11;
        }
        else if(searchby == "kecamatan"){
            var zoomrange = 11;
        }
        else if(searchby == "negara"){
            var zoomrange = 7;
        }
        else{
            var zoomrange = 17;
        }

        var location = [];
        var b;
        for(b = 0; b<data.length; b++){
            var html = '';
            html += '<b>'+data[b].school_name+'</b><br>'+
                    data[b].school_address+'<br>';
            var link = "https://www.google.com/maps/search/?api=1&query=";
            var full_link = link+data[b].latitude+","+data[b].longitude;  
            if(data[b].akreditasi == ""){
                var akreditasi = "-";
            }
            else{
                var akreditasi = data[b].akreditasi;
            }
            html += 'Akreditasi : '+akreditasi+'<br>';
            if(data[b].kurikulum == ""){
                var kurikulum = "-";
            }
            else{
                var kurikulum = data[b].kurikulum;
            }
            html += 'Kurikulum : '+kurikulum+'<br>';
            html += '<a href="'+full_link+'" target="_blank">Get me direction</a>';
            location.push([html, data[b].latitude, data[b].longitude]);
        }
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: zoomrange,
            center: new google.maps.LatLng(location[0][1], location[0][2]),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        
        var infowindow = new google.maps.InfoWindow();

        var markers = [];
        var marker, i;
        for (i = 0; i < location.length; i++) {  
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(location[i][1], location[i][2]),
                map: map
            });
            markers.push(marker);
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                infowindow.setContent(location[i][0]);
                infowindow.open(map, marker);
                
                }
            })(marker, i));
        }
        var markerCluster = new MarkerClusterer(map, markers,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
    }

    function InitializeMapStater(data,zoomrange) {
        var location = [];
        var b;
        for(b = 0; b<data.sekolah.length; b++){
            var html = '';
            html += '<b>'+data.sekolah[b].school_name+'</b><br>'+
                    data.sekolah[b].school_address+'<br>';
            var link = "https://www.google.com/maps/search/?api=1&query=";
            var full_link = link+data.sekolah[b].latitude+","+data.sekolah[b].longitude;  
            if(data.sekolah[b].akreditasi == ""){
                var akreditasi = "-";
            }
            else{
                var akreditasi = data.sekolah[b].akreditasi;
            }
            html += 'Akreditasi : '+akreditasi+'<br>';
            if(data.sekolah[b].kurikulum == ""){
                var kurikulum = "-";
            }
            else{
                var kurikulum = data.sekolah[b].kurikulum;
            }
            html += 'Kurikulum : '+kurikulum+'<br>';
            html += '<a href="'+full_link+'" target="_blank">Get me direction</a>';
            location.push([html, data.sekolah[b].latitude, data.sekolah[b].longitude]);
            
        }
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: zoomrange,
            center: new google.maps.LatLng(location[0][1], location[0][2]),
        });
        
        var infowindow = new google.maps.InfoWindow();
        var markers = [];
        var marker, i;
        for (i = 0; i < location.length; i++) {  
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(location[i][1], location[i][2]),
                map: map
            });
            markers.push(marker);
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                infowindow.setContent(location[i][0]);
                infowindow.open(map, marker);
                
                }
            })(marker, i));
        }
        var markerCluster = new MarkerClusterer(map, markers,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
    }

    function sekolahData()
    {
        $.ajax
        ({
            type  : 'get',
            url   : 'UserController/getSekolahDataSession',
            dataType : 'json',
            error: function(xhr) {
                console.log(xhr.responseText);
            },
            success : function(data)
            {
                var i;
                var html = '';
                html += '<thead>'+
                            '<tr>'+
                                '<th>'+'Nama Sekolah </th>'+
                                '<th>'+'Website </th>'+
                                '<th>'+'Email </th>'+
                                '<th>'+'Status Sekolah </th>'+
                                '<th>'+'Perintah  '+'</th>'+
                            '</tr>'+
                        '</thead>';

                for(i=0; i<data.sekolah.length; i++)
                {
                    html += '<tr>'+
                            '<td>'+data.sekolah[i].school_name+'</td>'+
                            '<td><a target="_blank" href="'+data.sekolah[i].website+'">'+data.sekolah[i].website+'</a></td>'+
                            '<td>'+data.sekolah[i].school_email+'</td>'+
                            '<td>'+data.sekolah[i].status_sekolah+'</td>'+
                            '<td><a href="javascript:;" class="btn btn-school-detail school_detail" data="'+data.sekolah[i].school_id+'">Lihat Detail</a></td>'+
                            '</tr>';
                }
                $('#mydata').html(html);
                $('#mydata').DataTable( {
                    rowReorder: {
                        selector: 'td:nth-child(2)'
                    },
                    responsive: true
                });
                var jenis = data.jenis;
                if(jenis == "provinsi")
                {
                    var zoomrange = 12;
                }
                else if(jenis == "kabupaten")
                {
                    var zoomrange = 11;
                }
                else if(jenis == "kecamatan")
                {
                    var zoomrange = 11;
                }
                else if(jenis == "negara")
                {
                    var zoomrange = 7;
                }
                else
                {
                    var zoomrange = 17;
                }
                InitializeMapStater(data,zoomrange);
            }
        });
    }

    $('#but_search2').on('click',function(){
        
        // var start_time = new Date().getTime();
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
                        var i;
                        var html = '';
                        html += '<thead>'+
                                    '<tr>'+
                                        '<th>'+'Nama Sekolah </th>'+
                                        '<th>'+'Website </th>'+
                                        '<th>'+'Email </th>'+
                                        '<th>'+'Status Sekolah </th>'+
                                        '<th>'+'Perintah </th>'+
                                    '</tr>'+
                                '</thead>';

                        for(i=0; i<data.length; i++)
                        {
                            html += '<tr>'+
                                    '<td>'+data[i].school_name+'</td>'+
                                    '<td><a target="_blank" href="'+data[i].website+'">'+data[i].website+'</a></td>'+
                                    '<td>'+data[i].school_email+'</td>'+
                                    '<td>'+data[i].status_sekolah+'</td>'+
                                    '<td><a href="javascript:;" class="btn btn-primary school_detail" data="'+data[i].school_id+'">Lihat Detail</a></td>'+
                                    '</tr>';
                        }
                        var table = $('#mydata').DataTable();
                        table.destroy();
                        $('#mydata').empty();
                        $('#mydata').html(html);
                        $('#mydata').DataTable();
                        var searchby = "sekolah";
                        InitializeMap(data,searchby);
                        $("#loading-screen").hide();
                        $("#loading-content").hide();
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
                        var i;
                        var html = '';
                        html += '<thead>'+
                                    '<tr>'+
                                        '<th>'+'Nama Sekolah </th>'+
                                        '<th>'+'Website </th>'+
                                        '<th>'+'Email </th>'+
                                        '<th>'+'Status Sekolah </th>'+
                                        '<th>'+'Perintah </th>'+
                                    '</tr>'+
                                '</thead>';

                        for(i=0; i<data.length; i++)
                        {
                            html += '<tr>'+
                                    '<td>'+data[i].school_name+'</td>'+
                                    '<td><a target="_blank" href="'+data[i].website+'">'+data[i].website+'</a></td>'+
                                    '<td>'+data[i].school_email+'</td>'+
                                    '<td>'+data[i].status_sekolah+'</td>'+
                                    '<td><a href="javascript:;" class="btn btn-primary school_detail" data="'+data[i].school_id+'">Lihat Detail</a></td>'+
                                    '</tr>';
                        }
                        var table = $('#mydata').DataTable();
                        table.destroy();
                        $('#mydata').empty();
                        $('#mydata').html(html);
                        $('#mydata').DataTable();
                        var searchby = "provinsi";
                        InitializeMap(data,searchby);
                        // var request_time = new Date().getTime() - start_time;
                        // var long_time = request_time/1000;
                        // console.log(long_time);
                        $("#loading-screen").hide();
                        $("#loading-content").hide();
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
                        var i;
                        var html = '';
                        html += '<thead>'+
                                    '<tr>'+
                                        '<th>'+'Nama Sekolah </th>'+
                                        '<th>'+'Website </th>'+
                                        '<th>'+'Email </th>'+
                                        '<th>'+'Status Sekolah </th>'+
                                        '<th>'+'Perintah </th>'+
                                    '</tr>'+
                                '</thead>';

                        for(i=0; i<data.length; i++)
                        {
                            html += '<tr>'+
                                    '<td>'+data[i].school_name+'</td>'+
                                    '<td><a target="_blank" href="'+data[i].website+'">'+data[i].website+'</a></td>'+
                                    '<td>'+data[i].school_email+'</td>'+
                                    '<td>'+data[i].status_sekolah+'</td>'+
                                    '<td><a href="javascript:;" class="btn btn-primary school_detail" data="'+data[i].school_id+'">Lihat Detail</a></td>'+
                                    '</tr>';
                        }
                        var table = $('#mydata').DataTable();
                        table.destroy();
                        $('#mydata').empty();
                        $('#mydata').html(html);
                        $('#mydata').DataTable();
                        var searchby = "sekolah";
                        InitializeMap(data,searchby);
                        $("#loading-screen").hide();
                        $("#loading-content").hide();
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
                        var i;
                        var html = '';
                        html += '<thead>'+
                                    '<tr>'+
                                        '<th>'+'Nama Sekolah </th>'+
                                        '<th>'+'Website </th>'+
                                        '<th>'+'Email </th>'+
                                        '<th>'+'Status Sekolah </th>'+
                                        '<th>'+'Perintah </th>'+
                                    '</tr>'+
                                '</thead>';

                        for(i=0; i<data.length; i++)
                        {
                            html += '<tr>'+
                                    '<td>'+data[i].school_name+'</td>'+
                                    '<td><a target="_blank" href="'+data[i].website+'">'+data[i].website+'</a></td>'+
                                    '<td>'+data[i].school_email+'</td>'+
                                    '<td>'+data[i].status_sekolah+'</td>'+
                                    '<td><a href="javascript:;" class="btn btn-school-detail school_detail" data="'+data[i].school_id+'">Lihat Detail</a></td>'+
                                    '</tr>';
                        }
                        var table = $('#mydata').DataTable();
                        table.destroy();
                        $('#mydata').empty();
                        $('#mydata').html(html);
                        $('#mydata').DataTable();
                        var searchby = "kabupaten";
                        InitializeMap(data,searchby);
                        $("#loading-screen").hide();
                        $("#loading-content").hide();
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
                        var i;
                        var html = '';
                        html += '<thead>'+
                                    '<tr>'+
                                        '<th>'+'Nama Sekolah </th>'+
                                        '<th>'+'Website </th>'+
                                        '<th>'+'Email </th>'+
                                        '<th>'+'Status Sekolah </th>'+
                                        '<th>'+'Perintah </th>'+
                                    '</tr>'+
                                '</thead>';

                        for(i=0; i<data.length; i++)
                        {
                            html += '<tr>'+
                                    '<td>'+data[i].school_name+'</td>'+
                                    '<td><a target="_blank" href="'+data[i].website+'">'+data[i].website+'</a></td>'+
                                    '<td>'+data[i].school_email+'</td>'+
                                    '<td>'+data[i].status_sekolah+'</td>'+
                                    '<td><a href="javascript:;" class="btn btn-school-detail school_detail" data="'+data[i].school_id+'">Lihat Detail</a></td>'+
                                    '</tr>';
                        }
                        var table = $('#mydata').DataTable();
                        table.destroy();
                        $('#mydata').empty();
                        $('#mydata').html(html);
                        $('#mydata').DataTable();
                        var searchby = "sekolah";
                        InitializeMap(data,searchby);
                        $("#loading-screen").hide();
                        $("#loading-content").hide();
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
                            var i;
                            var html = '';
                            html += '<thead>'+
                                        '<tr>'+
                                            '<th>'+'Nama Sekolah </th>'+
                                            '<th>'+'Website </th>'+
                                            '<th>'+'Email </th>'+
                                            '<th>'+'Status Sekolah </th>'+
                                            '<th>'+'Perintah </th>'+
                                        '</tr>'+
                                    '</thead>';

                            for(i=0; i<data.length; i++)
                            {
                                html += '<tr>'+
                                        '<td>'+data[i].school_name+'</td>'+
                                        '<td><a target="_blank" href="'+data[i].website+'">'+data[i].website+'</a></td>'+
                                        '<td>'+data[i].school_email+'</td>'+
                                        '<td>'+data[i].status_sekolah+'</td>'+
                                        '<td><a href="javascript:;" class="btn btn-school-detail school_detail" data="'+data[i].school_id+'">Lihat Detail</a></td>'+
                                        '</tr>';
                            }
                            var table = $('#mydata').DataTable();
                            table.destroy();
                            $('#mydata').empty();
                            $('#mydata').html(html);
                            $('#mydata').DataTable();
                            var searchby = "kecamatan";
                            InitializeMap(data,searchby);
                            $("#loading-screen").hide();
                            $("#loading-content").hide();
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
                            var i;
                            var html = '';
                            html += '<thead>'+
                                        '<tr>'+
                                            '<th>'+'Nama Sekolah </th>'+
                                            '<th>'+'Website </th>'+
                                            '<th>'+'Email </th>'+
                                            '<th>'+'Status Sekolah </th>'+
                                            '<th>'+'Perintah </th>'+
                                        '</tr>'+
                                    '</thead>';

                            for(i=0; i<data.length; i++)
                            {
                                html += '<tr>'+
                                        '<td>'+data[i].school_name+'</td>'+
                                        '<td><a target="_blank" href="'+data[i].website+'">'+data[i].website+'</a></td>'+
                                        '<td>'+data[i].school_email+'</td>'+
                                        '<td>'+data[i].status_sekolah+'</td>'+
                                        '<td><a href="javascript:;" class="btn btn-school-detail school_detail" data="'+data[i].school_id+'">Lihat Detail</a></td>'+
                                        '</tr>';
                            }
                            var table = $('#mydata').DataTable();
                            table.destroy();
                            $('#mydata').empty();
                            $('#mydata').html(html);
                            $('#mydata').DataTable();
                            var searchby = "sekolah";
                            InitializeMap(data,searchby);
                            $("#loading-screen").hide();
                            $("#loading-content").hide();
                        }
                    }
                });
            }
        }
    });

    $('#mydata').on('click','.school_detail',function(){
        var id=$(this).attr('data');
        $.ajax
        ({
            type  : 'get',
            url   : 'UserController/getSchoolDetail',
            dataType : 'json',
            data :{
                id:id
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            },
            success : function(data)
            {
                document.getElementById("npsnSekolah").innerHTML = data[0].school_code;
                document.getElementById("namaSekolah").innerHTML = data[0].school_name;
                document.getElementById("jenjangSekolah").innerHTML = data[0].jenjang_pendidikan;
                document.getElementById("statusSekolah").innerHTML = data[0].status_sekolah;
                document.getElementById("provinsiSekolah").innerHTML = data[0].nama_provinsi;
                document.getElementById("kabupatenSekolah").innerHTML = data[0].nama_kabupaten;
                document.getElementById("kecamatanSekolah").innerHTML = data[0].nama_kecamatan;
                document.getElementById("desaSekolah").innerHTML = data[0].kelurahan;
                document.getElementById("alamatSekolah").innerHTML = data[0].school_address;
                document.getElementById("rtrwSekolah").innerHTML = data[0].rt+' / '+data[0].rw;
                document.getElementById("kodeposSekolah").innerHTML = data[0].kode_pos;
                document.getElementById("skpendirianSekolah").innerHTML = data[0].sk_pendirian;
                document.getElementById("tanggalskpendirianSekolah").innerHTML = data[0].tanggal_pendirian;
                document.getElementById("statusKepemilikan").innerHTML = data[0].status_kepemilikan;
                document.getElementById("skizinOperasional").innerHTML = data[0].sk_izin;
                document.getElementById("tanggalskizinOperasional").innerHTML = data[0].tanggal_izin;
                document.getElementById("kebutuhanKhusus").innerHTML = data[0].kebutuhan_khusus;
                document.getElementById("noRekening").innerHTML = data[0].no_rekening;
                document.getElementById("namaBank").innerHTML = data[0].nama_bank;
                document.getElementById("cabangSekolah").innerHTML = data[0].cabang;
                document.getElementById("rekeningSekolah").innerHTML = data[0].account_name;
                document.getElementById("mbsSekolah").innerHTML = data[0].mbs;
                document.getElementById("luastanahSekolah").innerHTML = data[0].tanah_milik;
                document.getElementById("luastanahbukanSekolah").innerHTML = data[0].tanah_bukan_milik;
                document.getElementById("namawajibPajak").innerHTML = data[0].nwp;
                document.getElementById("npwpSekolah").innerHTML = data[0].npwp;
                document.getElementById("telpSekolah").innerHTML = data[0].school_phone;
                document.getElementById("emailSekolah").innerHTML = data[0].school_email;
                document.getElementById("faxSekolah").innerHTML = data[0].no_fax;
                document.getElementById("webSekolah").innerHTML = data[0].website;
                document.getElementById("cpSekolah").innerHTML = data[0].school_contact;
                document.getElementById("penyelenggaraSekolah").innerHTML = data[0].waktu_penyelenggaraan;
                document.getElementById("bosSekolah").innerHTML = data[0].bersedia_menerima_bos;
                document.getElementById("isoSekolah").innerHTML = data[0].sertifikasi_iso;
                document.getElementById("sumberlistrikSekolah").innerHTML = data[0].sumber_listrik;
                document.getElementById("dayalistrikSekolah").innerHTML = data[0].daya_listrik;
                document.getElementById("aksesinternetSekolah").innerHTML = data[0].akses_internet;
                document.getElementById("aksesinternetalternatifSekolah").innerHTML = data[0].internet_alternatif;
                document.getElementById("kepalaSekolah").innerHTML = data[0].kepsek;
                document.getElementById("operatorSekolah").innerHTML = data[0].operator;
                document.getElementById("akreditasiSekolah").innerHTML = data[0].akreditasi;
                document.getElementById("kurikulumSekolah").innerHTML = data[0].kurikulum;
                document.getElementById("totalguruSekolah").innerHTML = data[0].tguru;
                document.getElementById("totalsiswaSekolah").innerHTML = data[0].tsiswa_pria;
                document.getElementById("totalsiswiSekolah").innerHTML = data[0].tsiswa_wanita;
                document.getElementById("rombelSekolah").innerHTML = data[0].rombel;
                document.getElementById("rukelSekolah").innerHTML = data[0].ruang_kelas;
                document.getElementById("laboratoriumSekolah").innerHTML = data[0].laboratorium;
                document.getElementById("perpustakaanSekolah").innerHTML = data[0].perpustakaan;
                document.getElementById("sanitasiSekolah").innerHTML = data[0].sanitasi;

                $('#ModalDetail').modal('show');
            }
        });
    });

    function fillProvinsi()
    {
        $.ajax
        ({
            type  : 'get',
            url   : 'UserController/fillProvinsi',
            dataType : 'json',
            error: function(xhr) {
                console.log(xhr.responseText);
            },
            success : function(data)
            {
                var html = '';
                var i;
                html += '<option value="DKI JAKARTA"></option>';
                for(i=0; i<data.length; i++)
                {
                    html += 
                        '<option value="'+ data[i].nama_provinsi +'">'+'</option>';
                }
                $('#provinsi').html(html);
            }
        });
    }

    var timer;
    $('#tingkatNamaSekolah').on('keyup',function(){
        var tingkatSearch = $('#tingkatSearch').val();
        var tingkatProvinsi = $('#tingkatProvinsi').val();
        var tingkatKabupaten = $('#tingkatKabupaten').val();
        var tingkatKecamatan = $('#tingkatKecamatan').val();
        var tingkatNamaSekolah = $('#tingkatNamaSekolah').val();
        clearTimeout(timer);
        if(tingkatNamaSekolah == "")
        {
            var html = '';
            $('#sekolah').html(html);
        }
        else
        {
            timer = setTimeout(function() { 
                $.ajax
                ({
                    type  : 'get',
                    url   : 'UserController/fillSekolahStart',
                    dataType : 'json',
                    data : {
                        tingkatNamaSekolah:tingkatNamaSekolah,
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
                        var html = '';
                        var i;
                        if(data.length>0)
                        {
                            for(i=0; i<data.length; i++)
                            {
                                html += 
                                    '<option value="'+ data[i].school_name +'">'+'</option>';
                            }
                        }
                        else
                        {
                            var html='';
                            html+='<div class="alert alert-warning" role="alert">Tidak ada data sekolah yang terdaftar pada daerah tersebut..</div>';
                            $('#alert-content').html(html);
                            $('#alert-content').fadeIn(800);
                            setTimeout(function(){
                                $('#alert-content').fadeOut(2000);
                            },2000)
                        }
                        $('#sekolah').html(html);
                    }
                });
            }, 100);
        }
    });
    
    $('#tingkatProvinsi').on('blur',function()
    {   
        $('#tingkatKabupaten').val("");
        $('#tingkatKecamatan').val("");
        $('#tingkatNamaSekolah').val("");
        var provinsi = $('#tingkatProvinsi').val();
        $.ajax
        ({
            type  : 'get',
            url   : 'UserController/fillKabupaten',
            dataType : 'json',
            data : {
                provinsi:provinsi
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            },
            success : function(data)
            {
                var html = '';
                var i;
                if(data.length>0)
                {
                    for(i=0; i<data.length; i++)
                    {
                        html += 
                            '<option value="'+ data[i].nama_kabupaten +'">'+'</option>';
                    }
                    $('#kabupaten').html(html);
                }
                else
                {
                    html += 
                            '<option value="No result">'+'</option>';
                    $('#kabupaten').html(html);
                }
            }
        });
    });

    $('#tingkatKabupaten').on('blur',function()
    { 
        $('#tingkatKecamatan').val("");
        $('#tingkatNamaSekolah').val("");
        var kabupaten = $('#tingkatKabupaten').val();
        $.ajax
        ({
            type  : 'get',
            url   : 'UserController/fillKecamatan',
            dataType : 'json',
            data : {
                kabupaten:kabupaten
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            },
            success : function(data)
            {
                var html = '';
                var i;
                if(data.length>0)
                {
                    for(i=0; i<data.length; i++)
                    {
                        html += 
                            '<option value="'+ data[i].nama_kecamatan +'">'+'</option>';
                    }
                    $('#kecamatan').html(html);
                }
                else
                {
                    html += 
                            '<option value="No result">'+'</option>';
                    $('#kecamatan').html(html);
                }
            }
        });
    });
});
    
