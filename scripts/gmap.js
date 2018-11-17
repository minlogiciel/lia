var geocoder;
var map;
var infowindow = new google.maps.InfoWindow();
var marker;
function initializemaps() {        
	var address = "<div class=infoWindow>Long Island Academy<br><br>303 Sunnyside Blvd. </br>Suite #10, </br>Plainview, NY 11803</div>";
	var lat = 40.796823;
	var lng = -73.467025;

	geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(lat,  lng);

   
 	var mapOptions = { 
		center: latlng,       
		zoom: 15,          
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};        
	map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions); 

	geocoder.geocode( 
		{ 'latLng': latlng}, 
		function(results, status) {      
			map.setCenter(results[0].geometry.location);        
			marker = new google.maps.Marker({            
				map: map,           
				position: latlng       
			});      
	         //infowindow.setContent(results[1].formatted_address);
			infowindow.setContent(address);
            infowindow.open(map, marker);
		}
	);    	
}
