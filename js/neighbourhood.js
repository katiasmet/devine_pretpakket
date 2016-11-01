(function() {
	var markers = [];
	var neighbourhoodPage, map, searchBox;

	function initialize() {
		neighbourhoodPage = document.getElementById('map-canvas');

		if(neighbourhoodPage) {
			mapStart();
		}
	}

	function mapStart() {
		map = new google.maps.Map(document.getElementById('map-canvas'), { mapTypeId: google.maps.MapTypeId.ROADMAP});

		var defaultBounds = new google.maps.LatLngBounds(
		      new google.maps.LatLng(51.05231209999999, 3.7200821000000133),
		      new google.maps.LatLng(51.05231209999999,3.7200821000000133));
		map.fitBounds(defaultBounds);
		map.setOptions({ maxZoom: 18});

		// Searchbox
		var input = (document.getElementById('pac-input'));
		map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
		searchBox = new google.maps.places.SearchBox((input));

		// Search input
		google.maps.event.addListener(searchBox, 'places_changed', newPlace);
		google.maps.event.addListener(map, 'bounds_changed', function() {
		var bounds = map.getBounds();
			searchBox.setBounds(bounds);
		});

		var pretpakketten = [
		  ['Pretpakket', 51.05231209999999, 3.7200821000000133, 1]
		];

		setMarkers(map, pretpakketten);
	}

	function newPlace() {
		var places = searchBox.getPlaces();

	    if (places.length == 0) {
	      return;
	    }
	    for (var i = 0, marker; marker = markers[i]; i++) {
	      marker.setMap(null);
	    }

	    // For each place, get the icon, place name, and location.
	    markers = [];
	    var bounds = new google.maps.LatLngBounds();
	    for (var i = 0, place; place = places[i]; i++) {
	      var image = {
	        url: 'img/marker.svg',
	        size: new google.maps.Size(20, 28),
		    origin: new google.maps.Point(0,0),
		    anchor: new google.maps.Point(0, 28)
	      };

	      var marker = new google.maps.Marker({
	        map: map,
	        icon: image,
	        title: place.name,
	        position: place.geometry.location
	      });

	      markers.push(marker);

	      google.maps.event.addListener(marker, 'click', function() {
		    infowindow.open(map,marker);
		  });

	      bounds.extend(place.geometry.location);
	    }

	    map.fitBounds(bounds);
	}

	function setMarkers(map, locations) {
		var image = {
		    url: 'img/marker.svg',
		    size: new google.maps.Size(20, 28),
		    origin: new google.maps.Point(0,0),
		    anchor: new google.maps.Point(0, 28)
		  };

		var shape = {
		  coords: [1, 1, 1, 20, 18, 20, 18 , 1],
		  type: 'poly'
		};
		for (var i = 0; i < locations.length; i++) {
		    var pretpakket = locations[i];
		    var myLatLng = new google.maps.LatLng(pretpakket[1], pretpakket[2]);
		    var marker = new google.maps.Marker({
		        position: myLatLng,
		        map: map,
		        icon: image,
		        shape: shape,
		        title: pretpakket[0],
		        zIndex: pretpakket[3]
		    });
		}
	}

	google.maps.event.addDomListener(window, 'load', initialize);


})();
