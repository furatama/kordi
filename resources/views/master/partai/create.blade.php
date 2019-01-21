<!-- resources/views/song/create.blade.php -->

@extends('app')

@section('content')
	<div class="container">
		<h3>{{$form->getMethod() == 'POST' ? "Tambah " : "Ubah "}} Partai</h3>
		<hr/>
		{!! form_start($form); !!}
		<div class="row">
			<div class="col-md-12">
				{!! form_until($form, 'singkatan'); !!}
				@if (isset($img) && $img != '' && $img != null)
					<div class="offset-md-3 py-2">
						<img src="/storage/{{$img}}" height="100">
					</div>
				@endif
    		{!! form_until($form, 'submit'); !!}
			</div>
		</div>
		{!! form_end($form, false); !!}

  </div>
@endsection