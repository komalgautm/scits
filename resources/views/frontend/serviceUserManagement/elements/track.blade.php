
<?php //echo "<pre>"; print_r($su_all_running_locations); die; ?>
<script type="text/javascript">
    var latitude = {{ (isset($su_locations->latitude)) ? $su_locations->latitude : $focus_loc['latitude'] }};
    var longitude = {{ (isset($su_locations->longitude)) ? $su_locations->longitude : $focus_loc['longitude'] }};
    var last_running_latitude = {{ (isset($su_last_running_locations->latitude)) ? $su_last_running_locations->latitude : $focus_loc['latitude'] }};
    var last_running_longitude = {{ (isset($su_last_running_locations->longitude)) ? $su_last_running_locations->longitude : $focus_loc['longitude'] }};
    // console.log(latitude)
    // console.log('long===',longitude)
    var gmarkers = [];
    var polySize = [];
    var map, infoWindow;
    var directionsDisplay;
    var directionsService = new google.maps.DirectionsService();
    // var running_path = new google.maps.MVCArray();

    /*function initMap() {
        var pos = {
            lat: latitude,
            lng: longitude
        };
        map = new google.maps.Map(document.getElementById('map'), {
            center: pos,
            zoom: 10
        });
        
        var marker = new google.maps.Marker({
            position: pos,
            map: map,
            title : 'My location'
        });
        directionsDisplay = new google.maps.DirectionsRenderer();

        directionsDisplay.setMap(map);

        infoWindow = new google.maps.InfoWindow;
        //gmarkers.push(marker);

        
    }

    google.maps.event.addDomListener(window, 'load', initMap);*/

    function initialize(latitude_n,longitude_n) {
        // console.log('latitude_n++++',latitude_n)
        // console.log('longitude_n++++',longitude_n)

        var FocusLatlng = new google.maps.LatLng({{ $focus_loc['latitude'] }}, {{ $focus_loc['longitude'] }});

        <?php if(!empty($latest_loc)) {  ?>
            // console.log('1');
            // alert('first_map');
            var mapOptions = {
                zoom: 10,
                scrollwheel: false,
                center: FocusLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
        <?php } else { ?>
            // console.log('2');
           // alert('second_map');
            var mapOptions = {
                zoom: 2,
                scrollwheel: false,
                center: FocusLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
        <?php } ?>
        map = new google.maps.Map(document.getElementById('location-map'), mapOptions);

        /*var marker = new google.maps.Marker({
            position: FocusLatlng,
            map: map,
            optimized: false,
        });*/

        <?php if(!empty($latest_loc)){

            $latest_timestamp = $latest_loc['timestamp'];
        ?>
            var lat ="{{$latest_loc['latitude']}}";
            var long = "{{$latest_loc['longitude']}}";
            // console.log(lat);
            // console.log(latitude_n);
            // console.log(long);
            // console.log(longitude_n);
            if(latitude_n != null &&  longitude_n != null){
                var LastLatlng = new google.maps.LatLng(latitude_n,longitude_n);
            }else{
                var LastLatlng = new google.maps.LatLng({{ $latest_loc['latitude'] }}, {{ $latest_loc['longitude'] }});
            }
            // console.log(LastLatlng);
            var marker = new google.maps.Marker({
                position: LastLatlng,
                map: map,
                title: '{{ date("d-m-Y g:i a", strtotime($latest_timestamp)) }}',
                icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png' 
            });
            // console.log('-------- ',marker)
        <?php  } ?>

        <?php if(!empty($specified_locations)){ ?>
            //from source to destination
            //destination at the top of source
            var i = 0;
            <?php  foreach ($specified_locations as $key => $value) {  //$radius = '1400'; ?>
                    
                    var myLatlng1 = new google.maps.LatLng({{ $value['latitude'] }}, {{ $value['longitude'] }});
                   
                    <?php if($value['location_type'] == 'A'){ ?>

                        var radius = "{{$value['radius']}}";
                        // alert(radius);
                        var circle = new google.maps.Circle({
                            center: myLatlng1,
                            map: map,
                            radius: parseFloat(radius),    // 10 miles in metres
                            strokeColor: 'green'
                        });

                   <?php }else{ ?>

                        var radius = "{{$value['radius']}}";
                        // alert(radius);
                        var circle = new google.maps.Circle({
                            center: myLatlng1,
                            map: map,
                            radius: parseFloat(radius),    // 10 miles in metres
                            strokeColor: '#FF0000'
                        });
                   <?php } ?>
                i++;
            <?php } ?>
        <?php }   ?>
        reInitMap(last_running_latitude,last_running_longitude,'L')
    }

    google.maps.event.addDomListener(window, 'load', initialize);

    function reInitMap(latitude_n,longitude_n,type) { //alert("latitude "+latitude+" longitude"+longitude); 


        var poly = null;

        // var path = poly.getPath();
        // add new point (use the position from the click event)
        //path.push(new google.maps.LatLng(evt.latLng.lat(), evt.latLng.lng()));
        // update the polyline with the updated path
        // poly.setPath(null);

        // console.log('12==',latitude_n)
        // console.log('188==',longitude_n)
        // console.log('121==',latitude)
        // console.log('1881==',longitude)

        removeMarkers(); //removing previous markers
        removeLine();
         //removing previous markers
        /*var marker = new google.maps.Marker({ 
            position:  {lat: latitude, lng: longitude},
            map: map,
            title : 'My location'
        });*/
        //gmarkers.push(marker);
        LastLatlng = new google.maps.LatLng(latitude_n, longitude_n);
        // console.log('LastLatlng ',LastLatlng);

        <?php 
            if(!empty($latest_loc)){
                $latest_timestamp = $latest_loc['timestamp'];
            }else{
                $latest_timestamp = date("d-m-Y h:i a");
            }
        ?>
        var static_lat = "51.509865";
        var static_long = "-0.118092";
        // console.log('static==',static_lat)
        // console.log('static==',static_long)
        if(latitude == static_lat){
            latitude = latitude_n;
        }
        if(longitude == static_long){
            longitude = longitude_n;
        }
        //console
        // console.log('latitude===',latitude)
        // console.log('longitude===',longitude)
        // console.log('latitude_n',latitude_n)
        // console.log('longitude_n===',longitude_n)
        latitude1 = latitude.toFixed(3);
        longitude1 = longitude.toFixed(2);
        latitude_n1 = latitude_n.toFixed(3);
        longitude_n1 = longitude_n.toFixed(2);
        // console.log('latitude1==',latitude1)
        // console.log('latitude_n1==',latitude_n1)
        if(latitude1 != latitude_n1){
            var marker = new google.maps.Marker({
                position: LastLatlng,
                map: map,
                title: '{{ date("d-m-Y g:i a", strtotime(@$latest_timestamp)) }}',
                icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png' 
            });
            gmarkers.push(marker);
        }
       
        // console.log('marker ',marker);
       /* var marker = new google.maps.Marker({ //driver location (dynamic)
            position: { lat: latitude_n, lng: longitude_n },
            map: map,
            title:'Driver',
            icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png' 
        });*/

        
        //map.setCenter({lat: latitude_n, lng: longitude_n});
        //console.log(marker2);
        //marker2.setMap(null);

        // To add the marker to the map, call setMap();
        //marker.setMap(map);

        // To remove the marker from the map
        //marker.setMap(null);
         //drawing straight line
         // console.log(running_path)
        var running_path = [new google.maps.LatLng(latitude, longitude)];
        
        <?php if(!empty($su_all_running_locations)){
            foreach ($su_all_running_locations as $key => $value) { ?>
                // var lat = "{{ $value['latitude']}}";
                // var long = "{{$value['longitude']}}";
                // console.log('latttt==',lat);
                // console.log('long==',long);
                running_path.push(new google.maps.LatLng({{ $value['latitude']}}, {{$value['longitude']}})) 
        <?php } }?>
        if(type == 'R'){

            running_path.push(new google.maps.LatLng(latitude_n, longitude_n));
        }
        console.log(running_path);
        // if (poly && poly.setMap) poly.setMap(null);
        // if(latitude1 != latitude_n1){
            // poly.setMap(null);

            poly = new google.maps.Polyline({
                // path: [
                //     new google.maps.LatLng('30.8838', '75.8878'), 
                //     new google.maps.LatLng('30.8591', '75.8447'), 
                //     new google.maps.LatLng(latitude_n, longitude_n)
                // ],
                path:running_path,
                strokeColor: "#800080",
                strokeOpacity: 1.0,
                strokeWeight: 5,
                map: map
            });
            // poly.setPath(running_path);
            // google.maps.event.addListener(map, 'click', function(evt) {
                // get existing path
                // var path = poly.getPath();
                // // add new point (use the position from the click event)
                // path.push(new google.maps.LatLng(evt.latLng.lat(), evt.latLng.lng()));
                // // update the polyline with the updated path
                // poly.setPath(path);
            // })
            // poly.setMap(null);
            polySize.push(poly);
        // }
        // console.log(polySize);

        // console.log(latitude)
        // console.log(latitude)
        calcRoute(latitude,longitude,latitude_n,longitude_n);
        
        latitude_n = '';
        longitude_n = '';
    }

    function calcRoute(lat1,long1,lat2,long2) {

        var start = new google.maps.LatLng(lat1, long1);
        var end = new google.maps.LatLng(lat2, long2);
        
        //var start = new google.maps.LatLng(28.7041, 77.1025);
        //var end = new google.maps.LatLng(38.334818, -181.884886);
        //var end = new google.maps.LatLng(31.6340, 74.8723);
        var request = {
          origin: start,
          destination: end,
          travelMode: google.maps.TravelMode.DRIVING
        };
        directionsService.route(request, function(response, status) {
          if (status == google.maps.DirectionsStatus.OK) {
            // directionsDisplay.setDirections(response);
            //directionsDisplay.setMap(map);
            // directionsDisplay.setOptions( { suppressMarkers: true } ); //to remove default markers A & B
          } else {
            //if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT)
            if(status == "OVER_QUERY_LIMIT"){
                setTimeout(5000);
            }
            //alert("Directions Request from " + start.toUrlValue(6) + " to " + end.toUrlValue(6) + " failed: " + status);
          }
        });
        
        // line.setMap(map);
        start = '';
        end = '';
    }

    function removeMarkers(){
        for(i = 0; i < gmarkers.length; i++){
            gmarkers[i].setMap(null);
        }
    }

    function removeLine(){
        for(i = 0; i < polySize.length; i++){
            polySize[i].setMap(null);
        }
    }

    

</script>

<!-- if (poly && poly.setMap) poly.setMap(null); -->