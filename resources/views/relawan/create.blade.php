<!-- resources/views/song/create.blade.php -->

@extends('app')

@section('content')
	<div class="container">
		<h3>Tambah Data Relawan</h3>
		<hr/>
		{!! form_start($form); !!}
		<div class="row">
			<div class="col-md-6">
				{!! form_until($form, 'keterangan'); !!}
			</div>
			<div class="col-md-6 border-left">
    		{!! form_until($form, 'submit'); !!}
			</div>
		</div>
		{!! form_end($form, false); !!}

  </div>
@endsection