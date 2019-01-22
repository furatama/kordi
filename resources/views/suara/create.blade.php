<!-- resources/views/song/create.blade.php -->

@extends('app')

@section('content')
	<div class="container">
		<h3>Tambah Suara</h3>
		<hr/>
		{!! form_start($form); !!}
		<div class="row">
			<div class="col-md-6">
				{!! form_until($form, 'penanggung'); !!}
			</div>
			<div class="col-md-6 border-left">
    		{!! form_until($form, 'submit'); !!}
			</div>
		</div>
		{!! form_end($form, false); !!}

  </div>
@endsection

@push('scripts')
<script type="text/javascript">

		var tps = document.querySelector('#tps');
		var caleg = document.querySelector('#caleg');
		var tglsuara = document.querySelector('#tglsuara');
		var suara = document.querySelector('#suara');
		var penanggung = document.querySelector('#penanggung');
		var keterangan = document.querySelector('#keterangan');

		function checkData() {
			let idtps = tps.value;
			let idcaleg = caleg.value;
			if (!(idtps > 0) || !(idcaleg > 0))
				return;
			fetch(`{{route('suara.fetch')}}/${idtps}/${idcaleg}`)
			  .then(function(response) {
			    return response.json();
			  })
			  .then(function(res) {
			  	if (res.result == 'OK')
			  		return res.data;
			  	else
			  		throw new Error('Data not found');
			  })
			  .then(function(data) {
			  	if (confirm('Data suara caleg dengan tps ini sudah ada. Ubah data tsb?')) {
				  	tglsuara.value = data.tglsuara;
				  	suara.value = data.suara;
				  	penanggung.value = data.penanggung;
				  	keterangan.value = data.keterangan;
				  } else {
				  	tps.value = '';
				  	caleg.value = '';
				  }
			  	// console.log(JSON.stringify(data));
			  });
		}

		tps.onblur = () => {
			checkData();
		}

		caleg.onblur = () => {
			checkData();
		}


</script>
@endpush