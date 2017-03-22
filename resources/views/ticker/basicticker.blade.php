<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Basic Bitcoin widget</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
    #container{
    background-color: #2f2f2f;
    width: 270px;
    height: 90px;
    border: 1px solid #000;
        overflow: hidden;
        border-radius: 3px;
        color: #fefdfb;

    }

        #lastPrice{
            font-size: 30px;
        }

        #timeDate{
            color: #999;
            font-size: 9px;
        }


    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @if (Auth::check())
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ url('/login') }}">Login</a>
                <a href="{{ url('/register') }}">Register</a>
            @endif
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            {{--@foreach($rates as $rate)--}}

                {{--<li> {{ $rate->name }} </li>--}}
                {{--<li> {{ $rate->rate }} </li> <br>--}}

            {{--@endforeach--}}

            {{--{{ $rates}}--}}

        </div>

        <div id="container">
           <table width="100%">
            <tr>
                <td rowspan="3" width="60%" id="lastPrice">{{$last}}</td>
                <td align="right"> {%change}</td>
            </tr>
            <tr>
                <td align="right">High: {{$high}}</td>
            </tr>
            <tr>
                <td align="right">Low: {{$low}}</td>
            </tr>
            <tr>

                <td colspan="2" align="right" id="timeDate"> {{ $dateT =date("m-d-y h:i:sa") }}</td>
            </tr>

           </table>


        </div>


    </div>
</div>
</body>
</html>
