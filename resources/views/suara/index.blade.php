@extends('app')

@section('content')
		<div class="my-3 clearfix">
            <span class="h3 float-left">
                Data Suara
                <div class="h2">
                    <strong class="tegas">
                        {{($by == 'desa') ? 'Desa ' . $reg->nama : ''}}
                        {{($by == 'banjar') ? $reg->nama : ''}}
                    </strong>
                </div>
                <hr class="mb-0" />
            </span>
            <!-- <a class="btn btn-lg btn-danger float-right ml-2" href="{!! route('cetak',['from'=>'suara']) !!}">PDF</a> -->
            @if (Auth::user()->hasAccess('SUC'))
            <a class="btn btn-lg btn-primary float-right ml-2" href="{!! route('suara.report',['by'=>$by,'id'=>$id]) !!}">Peta Suara</a>
            <a class="btn btn-lg btn-success float-right" href="{!! route('suara.create') !!}">Tambah Data</a>
            @endif
		</div>
    <table class="table table-bordered" id="main-table">
        <thead>
            <tr>
                <th></th>
            	<th>ID</th>
                <th>TPS</th>
                <th>Caleg</th>
                <th>Suara</th>
                <th>Tgl</th>
                <th>Penanggung</th>
                <th>Keterangan</th>
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
        ajax: '{!! isset($mtableref) ? $mtableref : route('suara.fetch') !!}',
        aoColumns: [
            { mdata: 'no', name: 'no', orderable: false, searchable: false,
                render: function(data, type, row, meta) {
                    return meta.row + 1
                }
            },
        	{ data: 'id', name: 'id', visible: false, orderable: false, searchable: false },
            { data: 'tps.nama', name: 'tps.nama' },
            { data: 'caleg.nama', name: 'caleg.nama' },
            { data: 'suara', name: 'suara' },
            { data: 'tglsuara', name: 'tglsuara',
                render: function(data, type, row, meta) {
                    var date = new Date(data);
                    var day = date.getDate();
                    var monthIndex = date.getMonth() + 1;
                    var year = date.getFullYear();

                    return day + '/' + monthIndex + '/' + year;
                }
            },
            { data: 'penanggung', name: 'penanggung' },
            { data: 'keterangan', name: 'keterangan',
                render: function(data, type, row, meta) {
                    if (data == null || data == undefined) return '';
                    return data.length > 30 ? data.substr(0,30) + '...' : data
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
                        <form action="{{route('suara.index')}}/${row.id}" method="post" onsubmit="return confirm('Yakin ingin hapus data?');">
                          @csrf
                          @method('DELETE')
                            @if (Auth::user()->hasAccess('SUU'))
                            <button type="button" class="dropdown-item btn btn-info" id="main-edit" onclick="window.location = '{!! route('suara.index') !!}/${row.id}/edit'">Edit</button>
                            @endif
                            @if (Auth::user()->hasAccess('SUD'))
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