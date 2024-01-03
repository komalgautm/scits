<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>QR Codes</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>

<body class="text-center mt-5">
    <?php 
    $base_url = url('qrcode?user_id='); 
    // dd($user_details); 
    ?>
    {!! QrCode::size(300)->generate('{ user_id='.$id.', user_type='.$user_type.', name='.$name.', email='.$email.', phone='.$phone_no.', company_name='.$company.', company_logo='.$image.', company_id='.$company_id.' }') !!} 
</body>
</html>