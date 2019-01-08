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
@if (isset($data['subjudul2']))
<h3 align="center"  style="margin:0">{{$data['subjudul2']}}</h3>
@endif
<hr/>
<h4 align="center"  style="margin:0">{{$data['subjudul']}}</h4>

<?php
	// var_dump($data['data']);
	// die();
	$curChild = 0;
	$no = 1;
?>	
<div>
	@for($i = 0; $i < count($data['data']); $i++)
	
		@if ($curChild != $data['data'][$i]['idl1'])
			@if ($curChild != 0)
			</table>
			@endif
		<h5 style="margin-bottom:0" align="center">Koor Utama</h5>
		<h3 style="margin-top:0" align="center">{{$data['data'][$i]->koorl1->namalengkap}}</h3>
		<table cellpadding="0" cellspacing="0" align="center">
			<tr>
				<th>No</th>
	      <th>Nama</th>
	      <th>NIK</th>
	      <th>JK</th>
	      <th>Desa</th>
	      <th>Banjar</th>
	      <th>Kontak</th>
	     </tr>
	     {!! $curChild = $data['data'][$i]['idl1']; $no = 1 !!}
		@endif
			<tr>
				<td>{{$no}}</td>
	      <td>{{$data['data'][$i]['namalengkap']}}</td>
	      <td>{{$data['data'][$i]['nik']}}</td>
	      <td>{{$data['data'][$i]['jeniskelamin']}}</td>
	      <td>{{$data['data'][$i]['desa']->nama}}</td>
	      <td>{{$data['data'][$i]['banjar']->nama}}</td>
	      <td>{{json_decode($data['data'][$i]['kontak'])[0]->kontak}}</td>
	    </tr>
	    {{!! $no++ !!}}
	@endfor
</div>