@extends('app')

@section('content')
		<div class="my-3 clearfix">
            <span class="h3 float-left">
                Data Relawan
                <div class="h2">
                    <strong class="tegas">
                        {{($by == 'desa') ? 'Desa ' . $reg->nama : ''}}
                        {{($by == 'banjar') ? $reg->nama : ''}}
                    </strong>
                </div>
                <hr class="mb-0" />
            </span>
            <!-- <a class="btn btn-lg btn-danger float-right ml-2" href="{!! route('cetak',['from'=>'keybanjar']) !!}">PDF</a> -->
            @if (Auth::user()->hasAccess('RLC'))
            <a class="btn btn-lg btn-primary float-right ml-2" href="{!! route('keybanjar.report',['by'=>$by,'id'=>$id]) !!}">Report</a>
            <a class="btn btn-lg btn-success float-right" href="{!! route('keybanjar.create') !!}">Tambah Data</a>
            @endif
		</div>
    <table class="table table-bordered" id="main-table">
        <thead>
            <tr>
                <th></th>
            	<th>ID</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>JK</th>
                <th>Alamat</th>
                <th>Keterangan</th>
                <th>Kontak</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
@stop

@push('scripts')
<script>
$(function() {
    var table = $('#main-table').DataTable({
        // lengthMenu: [ [3, 5, 15, -1], [3, 5, 15, "All"] ],
        lengthMenu: [ 10,20,30 ],
        processing: true,
        serverSide: true,
        ajax: '{!! isset($mtableref) ? $mtableref : route('keybanjar.fetch') !!}',
        aoColumns: [
            { mdata: 'no', name: 'no', orderable: false, searchable: false,
                render: function(data, type, row, meta) {
                    return meta.row + 1
                }
            },
        	{ data: 'id', name: 'id', visible: false, orderable: false, searchable: false },
            { data: 'nik', name: 'nik' },
            { data: 'namalengkap', name: 'namalengkap' },
            { 
            	data: 'jeniskelamin', name: 'jeniskelamin', 
            	render: function(data, type, row, meta) {
            		return data == 'L' ? 'Laki-Laki' : (data == 'P' ? 'Perempuan' : 'Lainnya')
            	}
            },
            { data: 'alamat', name: 'alamat' },
            { data: 'keterangan', name: 'keterangan',
                render: function(data, type, row, meta) {
                    return data.length > 30 ? data.substr(0,30) + '...' : data.substr
                }
            },
            { 
            	data: 'kontak', name: 'kontak', 
            	render: function(data, type, row, meta) {
            		let s = ''
                    let cnvtd = data.replace(/&quot;/g, '\"');
                    obj = JSON.parse(cnvtd);
            		Object.keys(obj).forEach(function(k){
                        if (obj[k] != null && obj[k]['kontak'] != null)
					       s = `${s} <b>${obj[k]['tipe']}</b>: ${obj[k]['kontak']} <br/>`;
					}); 
            		return s;
            	}
            },
            { 
            	mdata: 'action', name: 'action', orderable: false, searchable: false,
            	render: function(data, type, row, meta) {
            		return `
                    <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown">
                        Detail
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <form action="{{route('keybanjar.index')}}/${row.id}" method="post" onsubmit="return confirm('Yakin ingin hapus data?');">
                          @csrf
                          @method('DELETE')
                            @if (Auth::user()->hasAccess('RLU'))
                            <button type="button" class="dropdown-item btn btn-info" id="main-edit" onclick="window.location = '{!! route('keybanjar.index') !!}/${row.id}/edit'">Edit</button>
                            @endif
                            @if (Auth::user()->hasAccess('RLD'))
                            <button class="dropdown-item btn btn-danger text-danger" type="submit" id="main-delete">Delete</button>
                            @endif
                        </form>
                    </div>`
            	},
            },
        ],
    });

});
</script>
@endpush