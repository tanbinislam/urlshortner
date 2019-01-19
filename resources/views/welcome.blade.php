<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ route('home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    {{ config('app.name', 'Laravel') }}
                </div>
                <p>Sweet and simple url shortner</p>
                <div class="input-group mb-3">
                    <input id="url" name="url" type="text" class="form-control" placeholder="https://Url.To.Shrink">
                    <div class="input-group-append">
                        <button id="submit-btn" role="button" class="btn btn-outline-secondary">Shrink</button>
                    </div>
                    <div id="invalid-msg" class="invalid-feedback"></div>
                </div>
                <p><span class="font-weight-bold">Tips: </span>Use http:// || https:// before any url</p>
                @guest
                <a href="{{route('lostandfound')}}">lost & found</a>
                @endguest
                <div id="short-div" class="card d-none">
                    <div class="card-body">
                        <p><span class="font-weight-bold text-danger">Main Url : </span><span id="main-url"></span></p>
                        <p><span class="font-weight-bold text-success">Shrink Url: </span><span id="short-url" class="font-weight-bold"></span></p>
                        <button title="Copy link to clopboard" id="copy-text" class="btn btn-outline-secondary font-weight-bold">Copy</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script>
            $("#submit-btn").click(function(){
                axios.post('{{route('save')}}', {
                url : $("#url").val(),
                _token : "{{ csrf_token() }}"
                })
                .then(function (response) {
                    $("#main-url").text(response.data.url);
                    $("#short-url").text(response.data.shorturl);
                    $("#short-div").removeClass("d-none");
                    $("#short-div").addClass("d-block");
                    $("#url").val("");                    
                    if($("#url").hasClass("is-invalid")){
                        $("#url").removeClass("is-invalid");
                    }
                })
                .catch(function (error) {
                    if(error.response.data){
                        if(error.response.data.errors.url){
                            $("#url").addClass("is-invalid");
                            $("#invalid-msg").text(error.response.data.errors.url);
                        }
                    }
                });
            });

            $("#copy-text").click(function(){
                var $temp = $("<input>");
                $("body").append($temp);
                var s_url = $("#short-url").text();
                $temp.val(s_url).select();
                document.execCommand("copy");
                $temp.remove();
                $("#copy-text").text("Coppied!");
            })
        </script>
    </body>
</html>
