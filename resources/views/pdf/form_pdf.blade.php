<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pdf</title>
    <link href="{{ asset('public/form/bootstrap.css') }}" rel="stylesheet">
    <link href="{{asset('public/form/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('public/form/formio.css') }}" rel="stylesheet">  
</head>

<body onload="laod()">

{{$title}}
{{$formdata->title}}
{{$formdata->pattern}}
    <div id="formio"></div>

<script src="{{ asset('public/form/formio.js') }}"></script>
<script type="text/javascript">
    
// Formio.createForm(document.getElementById('formio'), {
//     components: JSON.parse(localStorage.getItem("components"))
// });
function laod(){
    document.getElementById('formio').text("hello teing");
    alert();
}
//laod();
</script>
</body>

</html>