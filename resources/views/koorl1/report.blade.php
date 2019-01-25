@extends('app-report')

@section('title')
    {{'Koor Utama] '}}
    {{($by == 'desa') ? 'Desa ' . $reg->nama . ' ' : ''}}
    {{($by == 'banjar') ? $reg->nama  . ' ' : ''}}
    {{date('d/m/Y')}}
@endsection

@section('content')
		<div class="my-3 clearfix">
            <span class="h3 float-left">
                Data Koordinator Utama
                <div class="h2">
                    <strong class="tegas">
                        {{($by == 'desa') ? 'Desa ' . $reg->nama : ''}}
                        {{($by == 'banjar') ? $reg->nama : ''}}
                    </strong>
                </div>
                <hr class="mb-0" />
            </span>
            <button class="btn btn-lg btn-primary float-right d-print-none" onclick="window.print()">Print</button>
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
                <th>Banjar</th>
                <th>Desa</th>
                <th>TPS</th>
                <th>Kontak</th>
            </tr>
        </thead>
    </table>
@stop

@push('scripts')
<script>
$(function() {
    var table = $('#main-table').DataTable({
        lengthChange: false,
        ordering: true,
        paging: false,
        searching: false,
        info: false,
        data: {!! $data->get() !!},
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
            { data: 'banjar.nama', name: 'banjar.nama',
                render: function(data, type, row, meta) {
                    return data == undefined || data == null ? '-' : data
                }
             },
            { data: 'desa.nama', name: 'desa.nama' ,
                render: function(data, type, row, meta) {
                    return data == undefined || data == null ? '-' : data
                }
            },
            { data: 'tps.nama', name: 'tps.nama',
                render: function(data, type, row, meta) {
                    return data == undefined || data == null ? '-' : data
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
					       s = `${s} ${obj[k]['kontak']} <br/>`;
					}); 
            		return s;
            	}
            },
        ],
    });

    table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        });
    } ).draw();

});
</script>
@endpush