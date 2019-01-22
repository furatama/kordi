@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="akses" class="col-md-4 col-form-label text-md-right">{{ __('Hak Akses') }}</label>

                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheck1" value="L1R" checked>
                                    <label class="form-check-label" for="gridCheck1">
                                      Koor Utama (Read)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheck2" value="L1C">
                                    <label class="form-check-label" for="gridCheck2">
                                      Koor Utama (Create)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheck3" value="L1U">
                                    <label class="form-check-label" for="gridCheck3">
                                      Koor Utama (Update)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheck4" value="L1D">
                                    <label class="form-check-label" for="gridCheck4">
                                      Koor Utama (Delete)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheck5" value="L2R" checked>
                                    <label class="form-check-label" for="gridCheck5">
                                      Asisten (Read)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheck6" value="L2C">
                                    <label class="form-check-label" for="gridCheck6">
                                      Asisten (Create)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheck7" value="L2U">
                                    <label class="form-check-label" for="gridCheck7">
                                      Asisten (Update)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheck8" value="L2D">
                                    <label class="form-check-label" for="gridCheck8">
                                      Asisten (Delete)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheck9" value="PMR" checked>
                                    <label class="form-check-label" for="gridCheck9">
                                      Pemilih (Read)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheck10" value="PMC">
                                    <label class="form-check-label" for="gridCheck10">
                                      Pemilih (Create)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheck11" value="PMU">
                                    <label class="form-check-label" for="gridCheck11">
                                      Pemilih (Update)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheck12" value="PMD">
                                    <label class="form-check-label" for="gridCheck12">
                                      Pemilih (Delete)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheckB9" value="RLR" checked>
                                    <label class="form-check-label" for="gridCheckB9">
                                      Relawan (Read)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheckB10" value="RLC">
                                    <label class="form-check-label" for="gridCheckB10">
                                      Relawan (Create)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheckB11" value="RLU">
                                    <label class="form-check-label" for="gridCheckB11">
                                      Relawan (Update)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheckB12" value="RLD">
                                    <label class="form-check-label" for="gridCheckB12">
                                      Relawan (Delete)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheckC9" value="KBR" checked>
                                    <label class="form-check-label" for="gridCheckC9">
                                      Key Banjar (Read)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheckC10" value="KBC">
                                    <label class="form-check-label" for="gridCheckC10">
                                      Key Banjar (Create)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheckC11" value="KBU">
                                    <label class="form-check-label" for="gridCheckC11">
                                      Key Banjar (Update)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheckC12" value="KBD">
                                    <label class="form-check-label" for="gridCheckC12">
                                      Key Banjar (Delete)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheckD9" value="KKR" checked>
                                    <label class="form-check-label" for="gridCheckD9">
                                      Key Komunitas (Read)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheckD10" value="KKC">
                                    <label class="form-check-label" for="gridCheckD10">
                                      Key Komunitas (Create)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheckD11" value="KKU">
                                    <label class="form-check-label" for="gridCheckD11">
                                      Key Komunitas (Update)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheckD12" value="KKD">
                                    <label class="form-check-label" for="gridCheckD12">
                                      Key Komunitas (Delete)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheckE9" value="SUR" checked>
                                    <label class="form-check-label" for="gridCheckE9">
                                      Suara (Read)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheckE10" value="SUC">
                                    <label class="form-check-label" for="gridCheckE10">
                                      Suara (Create)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheckE11" value="SUU">
                                    <label class="form-check-label" for="gridCheckE11">
                                      Suara (Update)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheckE12" value="SUD">
                                    <label class="form-check-label" for="gridCheckE12">
                                      Suara (Delete)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheck13" value="SDR" checked>
                                    <label class="form-check-label" for="gridCheck13">
                                      Statistik Desa (Read)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheck14" value="SBR" checked>
                                    <label class="form-check-label" for="gridCheck14">
                                      Statistik Banjar (Read)
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" name="access[]" type="checkbox" id="gridCheck15" value="A">
                                    <label class="form-check-label" for="gridCheck15">
                                      As Admin
                                    </label>
                                  </div>

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
