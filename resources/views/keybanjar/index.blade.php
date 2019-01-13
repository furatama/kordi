@extends('app')

@section('content')
		<div class="my-3 clearfix">
            <span class="h3 float-left">
                Data Key Banjar
                <div class="h2">
                    <strong class="tegas">
                        {{($by == 'desa') ? 'Desa ' . $reg->nama : ''}}
                        {{($by == 'banjar') ? $reg->nama : ''}}
                    </strong>
                </div>
                <hr class="mb-0" />
            </span>
            <!-- <a class="btn btn-lg btn-danger float-right ml-2" href="{!! route('cetak',['from'=>'keybanjar']) !!}">PDF</a> -->
            @if (Auth::user()->hasAccess('KBC'))
            <a class="btn btn-lg btn-primary float-right ml-2" href="{!! route('keybanjar.report',['by'=>$by,'id'=>$id]) !!}">Report</a>
            <a class="btn btn-lg btn-success float-right" href="{!! route('keybanjar.create') !!}">Tambah Data</a>
            @endif
		</div>
    <table class="table table-bordered" id="main-table">
        <thead>
            <tr>
                <th></th>
            	<th>ID</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Desa</th>
                <th>Banjar</th>
                <th>Key</th>
                <th>Potensi</th>
                <th>Catatan</th>
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
            { data: 'nama', name: 'nama' },
            { data: 'nik', name: 'nik' },
            { data: 'desa.nama', name: 'desa.nama' },
            { data: 'banjar.nama', name: 'banjar.nama' },
            { 
                data: 'jabatan', name: 'jabatan', 
                render: function(data, type, row, meta) {
                    if (data == 'TK') return 'Tokoh Kharismatik';
                    if (data == 'PM') return 'Pemuda';
                    if (data == 'PR') return 'Perempuan';
                    return data;
                }
            },
            { data: 'suara', name: 'suara' },
            { data: 'keterangan', name: 'keterangan',
                render: function(data, type, row, meta) {
                    if (data == null || data == undefined) return '';
                    return data.length > 30 ? data.substr(0,30) + '...' : data;
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
                            @if (Auth::user()->hasAccess('KBU'))
                            <button type="button" class="dropdown-item btn btn-info" id="main-edit" onclick="window.location = '{!! route('keybanjar.index') !!}/${row.id}/edit'">Edit</button>
                            @endif
                            @if (Auth::user()->hasAccess('KBD'))
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