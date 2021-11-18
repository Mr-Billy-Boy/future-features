<!DOCTYPE html>
<html>
<head>
    <title>Generate - QR Code</title>
</head>
<body>
    
<div class="visible-print text-center">
     
    <center>
        @if ($image)
            <img  src="data:image/png;base64, {!! base64_encode($image) !!}" class="img-fluid " />
        @else
            Please check the parameter in the url
        @endif

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