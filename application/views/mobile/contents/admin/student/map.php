<style type="text/css">
  #map-canvas {
    width: 100%;
    height: 260px;
    background-color: #fff;
    border: 1px solid #999;
	text-overflow: ellipsis;
  }
</style>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuHae3MvvdGVotQ-VtcUF4SEL05nxk3WE&libraries=places"></script>

<div id="map-canvas"></div>		
<script>
	var map;
	var marker;
	
	function initialize()
	{
	    geocoder = new google.maps.Geocoder();
	    var latlng = new google.maps.LatLng(<?php echo $latitude ?>,<?php echo $longitude ?>);
	    var latlng2 = new google.maps.LatLng(<?php echo $latitude ?>,<?php echo $longitude ?>);
	  
	    var mapOptions = {
	        zoom: 17,
	        scaleControl: true,
	        center:  latlng,
	        draggable : true,
	        mapTypeId: google.maps.MapTypeId.ROADMAP
	    };
		
	    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  	  
	    marker = new google.maps.Marker({
	          map: map,
			  draggable : false,
	          position: latlng2
         });	  
	}
	
	google.maps.event.addDomListener(window, 'load', initialize);

</script>