<?php
/**
 * Created by PhpStorm.
 * User: Hasak
 * Date: 05.12.2018.
 * Time: 02:07
 */
?>
<!doctype html>
<!--suppress HtmlUnknownTarget -->
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="icon" href="{{asset("favicon.ico")}}">
    <link rel="stylesheet" href="{{asset("css/all.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/my.css")}}">

    <title>@yield('title',"Stranica") · Inout · Plavi Leptir</title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="mx-auto d-sm-flex d-block flex-sm-nowrap">
        <a class="navbar-brand" href="{{asset("/")}}"><span class="fas fa-box-open fa-fw"></span> Inout</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link onozaactive" href="{{asset("/skladiste")}}"><span class="fas fa-box fa-fw"></span> Skladište</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link onozaactive" href="{{asset("/stanje")}}"><span class="fas fa-cubes fa-fw"></span> Stanje</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link onozaactive" href="{{asset("/sklapalica")}}"><span class="fas fa-puzzle-piece fa-fw"></span> Sklapalica</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link onozaactive" href="{{asset("/artikli")}}"><span class="fas fa-box-open fa-fw"></span> Artikal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link onozaactive" href="{{asset("/dobavljaci")}}"><span class="fas fa-truck fa-fw"></span> Dobavljači</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link onozaactive" href="{{asset("/o")}}"><span class="fas fa-question-circle fa-fw"></span> About</a>
                </li>
				<li class="nav-item">
					@if(Auth::id())
						<a class="nav-link onozaactive" href="/logout"
						   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
							<span class="fas fa-fw fa-sign-out-alt"></span> {{ __('Logout') }}
						</a>
					@else
						<a class="nav-link onozaactive" href="/login">
							<span class="fas fa-fw fa-sign-in-alt"></span> {{ __('Login') }}
						</a>
					@endif

					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
					</form>
				</li>
            </ul>
        </div>
    </div>
</nav>

<main role="main" class="container">
    @yield('content')
</main>
<div class="mt-5">

</div>
<footer class="lastft bold">
	Copyright <span class="fa-fw fas fa-copyright"></span> 2018-{{date("Y")}} · <a href="https://www.plavileptir.ba/" target="_blank">Plavi Leptir d.o.o.</a><br>
	Designed <span class="fa-fw fas fa-pencil-alt"></span> and programmed <span class="fa-fw fas fa-code"></span> by: <a
			href="https://hasak.ba" target="_blank">Himzo Hasak</a>{{--By Ananaslı--}}
</footer>

<script src="{{asset("js/jq.min.js")}}"></script>
<script src="{{asset("js/popper.min.js")}}"></script>
<script src="{{asset("js/bootstrap.min.js")}}"></script>
<script src="{{asset("js/my.js")}}"></script>
</body>
</html>
