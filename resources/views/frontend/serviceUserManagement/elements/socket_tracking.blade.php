<!-- <script src="/socket.io/socket.io.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
<!-- <script src="https://cdn.socket.io/socket.io-1.3.4.js"></script> -->
<!-- <script src="{{ url('public/frontEnd/js/socket.io.js') }}"></script> -->
<script  type="text/javascript"> 
	//connectiong to server
	//var socket = io.connect('http://127.0.0.1:5002');
	var socket   = io.connect('http://3.17.125.238:3015');
    var service_user_id = '{{ $service_user_id }}';

    //joining a room to start receiving coordinates from driver
	socket.emit('room join',{ service_user_id:service_user_id });

	//acknowledging room has joined
	socket.on('room joined', function(data) {
		console.log('room joined');
	})

	//changing map marker location when a new location is received
	// setTimeout(function(){

		socket.on('new_location_got', function(data) {
			// console.log('new_location_got');
			// console.log('data====',data);
			if( (data.latitude != null) || (data.latitude != '') || (data.longitude != null) || (data.longitude != '') ){
			    var lat = Number(data.latitude);
			    var lng = Number(data.longitude);

			    console.log('lat ',lat);
			    console.log('lng ',lng);
			    reInitMap(lat,lng,'R');
			    // initialize(lat,lng);
			}
		})
	// },6000)
	
	//just for testing purpose
	function ldh_lat_long() {
		console.log(ldh_lat_long);

		//socket.emit('new_location', { order_id:order_id, latitude:30.9010, longitude:75.8573 });
		socket.emit('new_location', { order_id:order_id, latitude:30.95475255511701, longitude:75.84863489493728 });
		//socket.emit('new_location', { order_id:order_id, latitude:30.9547, longitude:75.8486 });
		//calcRoute(30.95475255511701,75.84863489493728,28.7041,77.1025);
	}

	function del_lat_long() {
		socket.emit('new_location', { order_id:order_id, latitude:28.7041, longitude:77.1025 });
	}

	function asr_lat_long() {
		socket.emit('new_location', { order_id:order_id, latitude:'31.6340', longitude:'74.8723' });
	}

	function leave_room() {
		socket.emit('room leave', { order_id:order_id });
	}
	//just for testing purpose end

</script>

<!-- just for testing purpose -->
<!-- <button onclick="ldh_lat_long()">ldh lat long</button>
<button onclick="del_lat_long()">delhi lat long</button>
<button onclick="asr_lat_long()">asr lat long</button>
<button onclick="leave_room()">leave room</button> -->