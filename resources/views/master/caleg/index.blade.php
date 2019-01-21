@extends('app')

@section('content')
    <div class="container">
		<div class="my-3 clearfix">
            <span class="h3 float-left">
                Master Caleg
                <hr class="mb-0" />
            </span>
            <!-- <a class="btn btn-lg btn-danger float-right ml-2" href="{!! route('cetak',['from'=>'master.caleg']) !!}">PDF</a> -->
            @if (Auth::user()->hasAccess('A'))
            <a class="btn btn-lg btn-success float-right" href="{!! route('master.caleg.create') !!}">Tambah Data</a>
            @endif
		</div>
        <table class="table table-bordered" id="main-table">
            <thead>
                <tr>
                    <th width="30">No</th>
                	<th width="100">Partai</th>
                    <th>No Urut</th>
                    <th>Nama</th>
                    <th>Foto</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
@stop

@push('scripts')
<script>
$(function() {
    var table = $('#main-table').DataTable({
        lengthMenu: [ 30 ],
        processing: true,
        serverSide: true,
        lengthChange: false,
        ajax: '{!! isset($mtableref) ? $mtableref : route('master.caleg.fetch') !!}',
        aoColumns: [
            { mdata: 'no', name: 'no', orderable: false, searchable: false,
                render: function(data, type, row, meta) {
                    return meta.row + 1
                }
            },
        	{ data: 'partai.singkatan', name: 'partai.singkatan' },
            { data: 'nourut', name: 'nourut' },
            { data: 'nama', name: 'nama' },
            { data: 'foto', name: 'foto',
                render: function(data, type, row, meta) {
                    return `<img src="{{asset('storage')}}/${data}" width="100">`
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
                        <form action="{{route('master.caleg.index')}}/${row.id}" method="post" onsubmit="return confirm('Yakin ingin hapus data?');">
                          @csrf
                          @method('DELETE')
                            @if (Auth::user()->hasAccess('A'))
                            <button type="button" class="dropdown-item btn btn-info" id="main-edit" onclick="window.location = '{!! route('master.caleg.index') !!}/${row.id}/edit'">Edit</button>
                            @endif
                            @if (Auth::user()->hasAccess('A'))
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