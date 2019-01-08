<style type="text/css">
	th, td {
		border: 1px solid;
		padding: 5px 2px;
	}

	div {
		margin-top: 20px;
	}
</style>

<title>{{$data['title']}}</title>

<h2 align="center"  style="margin:0">{{$data['judul']}}</h2>
<hr/>
<h4 align="center"  style="margin:0">{{$data['subjudul']}}</h4>

<?php
	// echo($data['data'][0]->namalengkap);
	// die();
	$curChild = 0;
	$curGrandChild = 0;
	$no = 1;
?>	
<div>
	@for($i = 0; $i < count($data['data']); $i++)
	
		@if ($curGrandChild != $data['data'][$i]->idl1)
			@if ($curGrandChild != 0)
			</table>
			@endif
			<h5 style="margin-bottom:0" align="center">Koor Utama</h5>
			<h3 style="margin-top:0" align="center">{{$data['data'][$i]->namal1}}</h3>
			<table cellpadding="0" cellspacing="0" align="center">
		@endif
			@if ($curChild != $data['data'][$i]->idl2)
				<tr><th colspan="7" style="background-color: #eee" align="center">Asisten : {{$data['data'][$i]->namal2}}</th></tr>
				<tr>
					<th>No</th>
		      <th>Nama</th>
		      <th>NIK</th>
		      <th>JK</th>
		      <th>Desa</th>
		      <th>Banjar</th>
		      <th>Kontak</th>
		     </tr>
		    {!! $no = 1; !!}
		   @endif
			<tr>
				<td>{{$no}}</td>
	      <td>{{$data['data'][$i]->namalengkap}}</td>
	      <td>{{$data['data'][$i]->nik}}</td>
	      <td>{{$data['data'][$i]->jeniskelamin}}</td>
	      <td>{{$data['data'][$i]->desa}}</td>
	      <td>{{$data['data'][$i]->banjar}}</td>
	      <td>{{json_decode($data['data'][$i]->kontak)[0]->kontak}}</td>
	    </tr>
	    {!! $curGrandChild = $data['data'][$i]->idl1; $curChild = $data['data'][$i]->idl2 !!}
	    {{!! $no++ !!}}
	@endfor
</div>