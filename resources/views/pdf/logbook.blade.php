<?php
$logBooks = $data['logBooks'];
$image_id = $data['image_id'];

if($image_id != '')
{
	$image = adminImgPath.'/'.$image_id;
}
else{
	$image = adminImgPath.'/default_user.jpg';
}



$url = "/";
$logo_url = "/images/scits.png";
$scits = "Scits";
$facebook_slug="http://www.facebook.com/sharer.php?u=http://www.socialcareitsolutions.co.uk&pictures=".asset('public/images/scits.png')."&p[title]=Scits";

//$facebook_slug="http://www.facebook.com/sharer.php?u=".url($url)."&t=Scits&p[url]=".asset($logo_url)."&p[title]=".$scits;
/*    $twitter_slug="https://twitter.com/intent/tweet?url=".url('/');
$google_slug="https://plus.google.com/share?url=".url('/');
*/
$twitter_slug="https://twitter.com/intent/tweet?url=http://www.socialcareitsolutions.co.uk&pictures";
$google_slug="https://plus.google.com/share?url=http://www.socialcareitsolutions.co.uk&pictures";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Scits</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <style>
	html, body {
		display: block;
	}
	.header{
		position: relative;
		padding: 10px;
		width:100%;
		background-color:#333;
	}
	.footer{
		padding: 10px;
		background-color:#333;
		text-align: center;
	}
	/* td {
		border: 1px solid black;
		border-collapse: collapse;
	} */
    </style>
</head>
<body>
	<div class="header">
		<img src="{{ $image }}" style="height:80px;">
		<img src="{{ asset('public/images/scits.png') }}" style="float:right;height:80px;">
	</div>
	<table class="table">
		<tbody>
			<tr style="color:#1f88b5;" class="table-active">
				<th style="width: 10%; padding:5px">Id</th>
				<th style="width: 25%; padding:5px">Staff Name</th>
				<th style="width: 25%; padding:5px">Service User</th>
				<th style="width: 25%; padding:5px">Category</th>
				<th style="width: 25%; padding:5px">Title</th>
				<th style="width: 40%; padding:5px">Details</th>
				<th style="width: 25%; padding:5px">Date</th>
				<th style="width: 10%; padding:5px">Late</th>				
			</tr>
			@foreach ($logBooks as $logBook)
				<tr style="width: 100%; padding:5px; text-align:top;">
					<td style="width: 10%; padding:5px">{{$logBook->id}}</td>
					<td style="width: 10%; padding:5px">{{$logBook->staff_name}}</td>
					@if(isset($logBook->service_user_name))
						<td style="width: 25%; padding:5px">{{$logBook->service_user_name}}</td>
					@endif					
					<td style="width: 10%; padding:5px">{{$logBook->category_name}}</td>
					<td style="width: 25%; padding:5px">{{$logBook->title}}</td>
					<td style="width: 40%; padding:5px">{{$logBook->details}}</td>
					<td style="width: 25%; padding:5px">{{$logBook->date}}</td>
					<td style="width: 10%; padding:5px">{{$logBook->is_late ? "Yes" : "No"}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<div class="footer">
		<div style="color:#fff;text-decoration:uppercase;margin:0;">
			© {{ date('Y') }} Omega Care Group (SCITS). All Rights Reserved | www.socialcareitsolutions.co.uk
			<!-- <ul type="none" style="padding:10px;"> -->

				<!-- <li style="display:inline-block;margin-right:5px;"><a href="{{$facebook_slug}}"><img src="{{ asset('public/images/facebook.png') }}" style="max-width:30px;"></a></li>
				<li style="display:inline-block;margin-right:5px;"><a href="{{$twitter_slug}}"><img src="{{ asset('public/images/twitter.png') }}" style="max-width:30px;"></a></li>
				<li style="display:inline-block;margin-right:5px;"><a href="{{$google_slug}}"><img src="{{ asset('public/images/googleplus.png') }}" style="max-width:30px;"></a></li> -->
				<!-- <li style="display:inline-block;"><a href="javascript:void(0)"><img src="{{ asset('public/images/instagram.png') }}" style="max-width:30px;"></a></li> -->
			<!-- </ul> -->
		</div>
		<!-- <div> -->
			<!-- <p style="color:#fff;text-decoration:uppercase;margin:0;">{{ date('Y') }} &copy; Scits</p> -->
		</div>
	</div>
</body>
</html>