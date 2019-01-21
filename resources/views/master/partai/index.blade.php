@extends('app')

@section('content')
    <div class="container">
		<div class="my-3 clearfix">
            <span class="h3 float-left">
                Master Partai
                <hr class="mb-0" />
            </span>
            <!-- <a class="btn btn-lg btn-danger float-right ml-2" href="{!! route('cetak',['from'=>'master.partai']) !!}">PDF</a> -->
            @if (Auth::user()->hasAccess('A'))
            <a class="btn btn-lg btn-success float-right" href="{!! route('master.partai.create') !!}">Tambah Data</a>
            @endif
		</div>
        <table class="table table-bordered" id="main-table">
            <thead>
                <tr>
                    <th width="30">No</th>
                	<th width="100">Lambang</th>
                    <th>Sebutan</th>
                    <th>Nama</th>
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
        ajax: '{!! isset($mtableref) ? $mtableref : route('master.partai.fetch') !!}',
        aoColumns: [
        	{ data: 'nourut', name: 'nourut' },
            { data: 'lambang', name: 'lambang',
                render: function(data, type, row, meta) {
                    return `<img src="{{asset('storage')}}/${data}" width="100">`
                }
            },
            { data: 'singkatan', name: 'singkatan' },
            { data: 'nama', name: 'nama' },
            { 
            	mdata: 'action', name: 'action', orderable: false, searchable: false,
            	render: function(data, type, row, meta) {
            		return `
                    <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown">
                        Detail
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <form action="{{route('master.partai.index')}}/${row.id}" method="post" onsubmit="return confirm('Yakin ingin hapus data?');">
                          @csrf
                          @method('DELETE')
                            @if (Auth::user()->hasAccess('A'))
                            <button type="button" class="dropdown-item btn btn-info" id="main-edit" onclick="window.location = '{!! route('master.partai.index') !!}/${row.id}/edit'">Edit</button>
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