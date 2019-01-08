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

	
<div>
	<table cellpadding="0" cellspacing="0" align="center">
		<tr>
			<th></th>
      <th>Nama</th>
      <th>NIK</th>
      <th>JK</th>
      <th>Desa</th>
      <th>Banjar</th>
      <th>Kontak</th>
     </tr>
     @for($i = 0; $i < count($data['data']); $i++)
     <tr>
			<td>{{$i+1}}</td>
      <td>{{$data['data'][$i]['namalengkap']}}</td>
      <td>{{$data['data'][$i]['nik']}}</td>
      <td>{{$data['data'][$i]['jeniskelamin']}}</td>
      <td>{{$data['data'][$i]['desa']->nama}}</td>
      <td>{{$data['data'][$i]['banjar']->nama}}</td>
      <td>{{json_decode($data['data'][$i]['kontak'])[0]->kontak}}</td>
     </tr>
     @endfor
	</table>
</div>