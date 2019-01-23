<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DATABASE RELAWAN V1.0</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="{{asset('css/app.css')}}" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #eee;
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

        <div class="container">
            <div class="row ">
                <div class="col-md-5 mt-5">
                    <h1 class="mt-5">Welcome, {{ ucwords(Auth::user()->username) }}</h1>

                    <h3>
                        <a href="{{ route('changepw.show') }}">
                            Ganti Password
                        </a>
                    </h3>

                    @if (Auth::user()->hasAccess('A'))
                    <h3>
                        <a href="{{ route('register') }}">
                            Buatkan Akun
                        </a>
                    </h3>
                    @endif

                    <h3>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                    </h3>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
                <div class="col-md-7 mt-5 row">
                    <h2 class="text-center col-md-12">Database Relawan V1.0</h2>
                    <div class="mt-4 col-md-6">
                        <h4>Input Data</h4>
                        <ul>
                            @if (Auth::user()->hasAccess('L1R'))
                            <li><a class="h4 text-info" href="{{route('koorl1.index')}}">Koordinator Utama</a></li>
                            @endif
                            @if (Auth::user()->hasAccess('L2R'))
                            <li><a class="h4 text-info" href="{{route('koorl2.index')}}">Asisten Koordinator</a></li>
                            @endif
                            @if (Auth::user()->hasAccess('PMR'))
                            <li><a class="h4 text-info" href="{{route('pemilih.index')}}">Pemilih</a></li>
                            @endif
                            @if (Auth::user()->hasAccess('RLR'))
                            <hr/>
                            <li><a class="h4 text-info" href="{{route('relawan.index')}}">Relawan</a></li>
                            @endif
                            <hr/>
                            @if (Auth::user()->hasAccess('KBR'))
                            <li><a class="h4 text-info" href="{{route('keybanjar.index')}}">Key Person/Banjar</a></li>
                            @endif
                            @if (Auth::user()->hasAccess('KKR'))
                            <li><a class="h4 text-info" href="{{route('keykomunitas.index')}}">Key Person Komunitas</a></li>
                            @endif
                        </ul>
                    </div>
                    <div class="mt-4 col-md-6">
                        <h4>Cetak Keseluruhan</h4>
                        <ul>
                            @if (Auth::user()->hasAccess('L1R'))
                            <!-- <li><a class="h4 text-info" href="{{route('cetak',['source'=>'koorl1'])}}">Koordinator Utama</a></li> -->
                            <li><a class="h4 text-info" href="{{route('koorl1.report',['all','all'])}}">Koordinator Utama</a></li>
                            @endif
                            @if (Auth::user()->hasAccess('L2R'))
                            <!-- <li><a class="h4 text-info" href="{{route('cetak',['source'=>'koorl2'])}}">Asisten 
                            Koordinator</a></li> -->
                            <li><a class="h4 text-info" href="{{route('koorl2.report',['all','all'])}}">Asisten Koordinator</a></li>
                            @endif
                            @if (Auth::user()->hasAccess('PMR'))
                            <!-- <li><a class="h4 text-info" href="{{route('cetak',['source'=>'pemilih'])}}">Pemilih</a></li> -->
                            <li><a class="h4 text-info" href="{{route('pemilih.report',['all','all'])}}">Pemilih</a></li>
                            @endif
                            @if (Auth::user()->hasAccess('RLR'))
                            <li><a class="h4 text-info" href="{{route('relawan.report',['all','all'])}}">Relawan</a></li>
                            @endif
                        </ul>

                        @if (Auth::user()->hasAccess('SUR'))
                        <h4 class="mt-4"><a class="h4 text-info" href="{{route('suara.index')}}">* Input Suara Pemilih *</a></h4>
                        @endif
                    </div>
                    <div class="mt-4 col-md-6">
                        <h4>Data Statistik</h4>
                        <ul>
                            @if (Auth::user()->hasAccess('SDR'))
                            <li><a class="h4 text-info" href="{{route('stats.kecamatan')}}">Statistik Per Desa</a></li>
                            @endif
                            @if (Auth::user()->hasAccess('SBR'))
                            <li><a class="h4 text-info" href="{{route('stats.desa')}}">Statistik Per Banjar</a></li>
                            @endif
                        </ul>
                    </div>
                    @if (Auth::user()->hasAccess('A'))
                    <div class="mt-4 col-md-6">
                        <h4>Master Data</h4>
                        <ul>
                            <!-- <li><a class="h4 text-info" href="{{route('master.user')}}">Master User</a></li> -->
                            <li><a class="h4 text-info" href="{{route('master.desa')}}">Master Desa</a></li>
                            <li><a class="h4 text-info" href="{{route('master.banjar')}}">Master Banjar</a></li>
                            <li><a class="h4 text-info" href="{{route('master.tps')}}">Master TPS</a></li>
                            <li><a class="h4 text-info" href="{{route('master.caleg.index')}}">Master Caleg</a></li>
                            <li><a class="h4 text-info" href="{{route('master.partai.index')}}">Master Partai</a></li>
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>


        <!-- <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
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
                    DATABASE RELAWAN V1.0
                </div>

                <div class="links">
                    <a class="btn btn-info" href="{{route('koorl1.index')}}">Data Koordinator Utama</a>
                    <a class="btn btn-info" href="{{route('koorl2.index')}}">Data Asisten Koordinator</a>
                    <a class="btn btn-info" href="{{route('pemilih.index')}}">Data Pemilih</a>
                </div>
            </div>
        </div> -->
        <footer class="footer" style="position: absolute;bottom:0;font-size: 11px">
            Yang masih kurang: 
| impor data pemilih (dr .xls atau .csv)
| ekspor data ke .xls atau csv
| backup data (ke .sql atau apa aja)
        </footer>
    </body>
</html>
