<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-signin-client_id" content="1021084078614-pumhnvb1c40tu74vuv67tgaaaucphog7.apps.googleusercontent.com">

    @yield('meta')
    <title>@yield('title') - Future feature</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
    <script>
        var token = '{{ csrf_token() }}';

        function onSignIn(googleUser) {
            var profile = googleUser.getBasicProfile();

            var formData = new FormData();
            formData.append('_token',           token);
            formData.append('given_name',       profile.getGivenName());
            formData.append('family_name',      profile.getFamilyName());
            formData.append('profile_image',    profile.getImageUrl());
            formData.append('email',            profile.getEmail());

            var xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = function()
            {
                if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
                {
                    console.log(JSON.parse(xmlHttp.responseText));
                }
            }
            xmlHttp.open("POST", "/login-with-google"); 
            xmlHttp.send(formData);

            var url = window.location.href;
            var urls = url.split('/');

            console.log(urls[3]);

            if (gapi.auth2 && urls[3] == 'login')
            {
                window.location.replace("/dashboard");
            }
        }

        function signOut() {
            // if(!gapi.auth2){
            //     gapi.load('auth2', function() {
            //         gapi.auth2.init();
            //     });
            // }

            var auth2 = gapi.auth2.getAuthInstance();
            console.log(auth2);

            auth2.signOut().then(function () {
                window.location.replace("/login");
            });
        }

        function onLoad() {
            gapi.load('auth2', function() {
                gapi.auth2.init();
            });
        }
    </script>
    @yield('js')
</body>
</html>