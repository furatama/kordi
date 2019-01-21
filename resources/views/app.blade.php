<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DBase Relawan 1.0</title>

        <!-- Bootstrap CSS -->
        <link href="{{asset('css/app.css')}}" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
          <div class="container">
            <a class="navbar-brand" href="{{route('index-page')}}">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample07">
              <ul class="navbar-nav ml-auto">
                @if (Auth::user()->hasAccess('L1R'))
                <li class="nav-item active">
                  <a class="nav-link" href="{{route('koorl1.index')}}">
                    Koordinator Utama <span class="badge {{(App\Koorl1::count() <= 30 ? 'badge-warning' : 'badge-danger')}}"> Jumlah: {{App\Koorl1::count()}}</span>
                  </a>
                </li>
                @endif
                @if (Auth::user()->hasAccess('L2R'))
                <li class="nav-item active">
                  <a class="nav-link" href="{{route('koorl2.index')}}">
                    Asisten <span class="badge {{(App\Koorl2::count() <= 300 ? 'badge-warning' : 'badge-danger')}}">Jumlah: {{App\Koorl2::count()}}</span>
                  </a>
                </li>
                @endif
                @if (Auth::user()->hasAccess('PMR'))
                <li class="nav-item active">
                  <a class="nav-link" href="{{route('pemilih.index')}}">Pemilih <span class="badge {{(App\Pemilih::count() <= 6000 ? 'badge-warning' : 'badge-danger')}}">Jumlah: {{App\Pemilih::count()}}</span></a>
                </li>
                @endif
                @if (Auth::user()->hasAccess('RLR'))
                <li class="nav-item active">
                  <a class="nav-link" href="{{route('relawan.index')}}">Relawan <span class="badge {{(App\Relawan::count() <= 60000 ? 'badge-warning' : 'badge-danger')}}">Jumlah: {{App\Relawan::count()}}</span></a>
                </li>
                @endif
                @if (Auth::user()->hasAccess('SBR') || Auth::user()->hasAccess('SDR'))
                <li class="nav-item active dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Statistik
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @if (Auth::user()->hasAccess('SDR'))
                      <a class="dropdown-item" href="{{route('stats.kecamatan')}}">Statistik Per Desa</a>
                    @endif
                    @if (Auth::user()->hasAccess('SBR'))
                      <a class="dropdown-item" href="{{route('stats.desa')}}">Statistik Per Banjar</a>
                    @endif
                    </div>
                </li>
                @endif
                @if (Auth::user()->hasAccess('A'))
                <li class="nav-item active dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Master
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{route('master.desa')}}">Master Desa</a>
                      <a class="dropdown-item" href="{{route('master.banjar')}}">Master Banjar</a>
                      <a class="dropdown-item" href="{{route('master.tps')}}">Master TPS</a>
                      <a class="dropdown-item" href="{{route('master.partai.index')}}">Master Partai</a>
                      <a class="dropdown-item" href="{{route('master.caleg.index')}}">Master Caleg</a>
                    </div>
                </li>
                @endif
                <li class="nav-item active dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ ucwords(Auth::user()->username) }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </div>
          </div>
        </nav>
        <div class="container-fluid my-3">
            @yield('content')
        </div>

        <script src="{{asset('js/app.js')}}"></script>
        @stack('scripts')

        <script type="text/javascript">

            var listDesa = <?=json_encode(App\Desa::select(['id','nama'])->get())?>;
            var listBanjar = <?=json_encode(App\Banjar::select(['id','nama','iddesa'])->get())?>;
            var listTPS = <?=json_encode(App\TPS::select(['id','nama','idbanjar'])->get())?>;

            let desa = document.querySelector('#desa');
            let banjar = document.querySelector('#banjar');
            let tps = document.querySelector('#tps');

            desa.onchange = function() {
                let id = this.value;
                let filtered = listBanjar.filter(banjar => banjar.iddesa == id);
                for (let opt of [...banjar.querySelectorAll('option')]) {
                    if (filtered.find(banjar => banjar.id == opt.value) == undefined) {
                        opt.hidden = true;
                    } else {
                        opt.hidden = false;
                    }
                }
            }

            // banjar.onchange = function() {
            //     let id = this.value;
            //     let filtered = listTPS.filter(tps => tps.idbanjar == id);
            //     for (let opt of [...tps.querySelectorAll('option')]) {
            //         if (filtered.find(tps => tps.id == opt.value) == undefined) {
            //             opt.hidden = true;
            //         } else {
            //             opt.hidden = false;
            //         }
            //     }
            // }

            window.onload = function() {
                let id = desa.value;
                let filtered = listBanjar.filter(banjar => banjar.iddesa == id);
                for (let opt of [...banjar.querySelectorAll('option')]) {
                    if (filtered.find(banjar => banjar.id == opt.value) == undefined) {
                        opt.hidden = true;
                    } else {
                        opt.hidden = false;
                    }
                }

                // id = banjar.value;
                // filtered = listTPS.filter(tps => tps.idbanjar == id);
                // for (let opt of [...tps.querySelectorAll('option')]) {
                //     if (filtered.find(tps => tps.id == opt.value) == undefined) {
                //         opt.hidden = true;
                //     } else {
                //         opt.hidden = false;
                //     }
                // }

            }


        </script>
    </body>
</html>