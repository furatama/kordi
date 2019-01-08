@extends('app')

@section('content')
    <div class="my-3 clearfix">
        <div class="h4 float-left">
            Data Pemilih 
                    {{($by == 'koorl1') ? 'Menurut Koordinator' :''}}
                    {{($by == 'koorl2') ? 'Menurut Asisten' :''}}
                    {{($by == 'all') ? 'Lengkap' :''}}
                <div class="h2">
                    <strong class="tegas">
                        {{($by == 'koorl1') ? $reg->namalengkap : ''}}
                        {{($by == 'koorl2') ? $reg->namalengkap : ''}}
                        {{($by == 'desa') ? 'Desa ' . $reg->nama : ''}}
                        {{($by == 'banjar') ? $reg->nama : ''}}
                    </strong>
            </div>
            <hr class="mb-0" />
        </div>
        @if (isset($person))
            @if (isset($person->koorutama))
                <!-- <a class="btn btn-lg btn-primary float-right ml-2" href="{!! route('cetak.detail',['from'=>'pemilih','source'=>'koorl1','id'=>$person->id]) !!}">Print</a> -->
            @else
                <!-- <a class="btn btn-lg btn-primary float-right ml-2" href="{!! route('cetak.detail',['from'=>'pemilih','source'=>'koorl2','id'=>$person->id]) !!}">Print</a> -->
            @endif
        @else
            <!-- <a class="btn btn-lg btn-primary float-right ml-2" href="{!! route('cetak',['from'=>'pemilih']) !!}">Print</a> -->
        @endif
        @if (Auth::user()->hasAccess('PMC'))
        <a class="btn btn-lg btn-primary float-right ml-2" href="{!! route('pemilih.report',['by'=>$by,'id'=>$id]) !!}">Report</a>
        <a class="btn btn-lg btn-success float-right" href="{!! route('pemilih.create') !!}{{isset($person) ? '/' . $person->id : ''}}">Tambah Data</a>
        @endif
    </div>
    <table class="table table-bordered" id="main-table">
        <thead>
            <tr>
                <th></th>
            	<th>ID</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Asisten</th>
                <th>JK</th>
                <th>Alamat</th>
                <th>Banjar</th>
                <th>Desa</th>
                <th>TPS</th>
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
        // lengthMenu: [ [3, 5, 15, 30, 100, -1], [3, 5, 15, 30, 100, "All"] ],
        lengthMenu: [ 10,50,100,500,1000 ],
        processing: true,
        serverSide: true,
        ajax: '{{$mtableref}}',
        aoColumns: [
            { 
                mdata: 'no', name: 'no',  
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            { data: 'id', name: 'id', visible: false, orderable: false, searchable: false },
            { data: 'namalengkap', name: 'namalengkap' },
            { data: 'nik', name: 'nik' },
            { data: 'koorl2.namalengkap', name: 'koorl2.namalengkap' },
            { 
            	data: 'jeniskelamin', name: 'jeniskelamin', 
            	render: function(data, type, row, meta) {
            		return data == 'L' ? 'Laki-Laki' : (data == 'P' ? 'Perempuan' : 'Lainnya')
            	}
            },
            { data: 'alamat', name: 'alamat' },
            { data: 'banjar.nama', name: 'banjar.nama' },
            { data: 'desa.nama', name: 'desa.nama' },
            { data: 'tps.nama', name: 'tps.nama' },
            { 
            	data: 'kontak', name: 'kontak', 
            	render: function(data, type, row, meta) {
            		let s = ''
            		let cnvtd = data.replace(/&quot;/g, '\"');
            		obj = JSON.parse(cnvtd)
            		Object.keys(obj).forEach(function(k){
                        if (obj[k]['kontak'] != null)
					       s = `${s} <b>${obj[k]['tipe']}</b>: ${obj[k]['kontak']} <br/>`;
					}); 
            		return s;
            	}
            },
            { 
            	data: '', name: 'action', orderable: false, searchable: false,
            	render: function(data, type, row, meta) {
            		return `
    	            	<a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown">
                            Detail
                        </a>

                        <div class="dropdown-menu">
                            <form action="{{route('pemilih.index')}}/${row.id}" method="post" onsubmit="return confirm('Yakin ingin hapus data?');">
                              @csrf
                              @method('DELETE')
                                @if (Auth::user()->hasAccess('PMU'))
                                <button type="button" class="dropdown-item btn btn-info" id="main-edit" onclick="window.location = '{!! route('pemilih.index') !!}/${row.id}/edit'">Edit</button>
                                @endif
                                @if (Auth::user()->hasAccess('PMD'))
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