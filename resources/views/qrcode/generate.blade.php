<!DOCTYPE html>
<html>
<head>
    <title>Generate - QR Code</title>
</head>
<body>
    
<div class="visible-print text-center">
     
    <center>
        <img  src="data:image/png;base64, {!! base64_encode($qrcode) !!}" class="img-fluid " />

        <h4>
            {!! $title !!}<br>
            <span>
                {!! $subtitle !!}
            </span>
        </h4>
    </center>
</div>
    
</body>
</html>