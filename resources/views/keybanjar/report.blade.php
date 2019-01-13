@extends('app-report')

@section('title')
    {{'Relawan] '}}
    {{($by == 'desa') ? 'Desa ' . $reg->nama . ' ' : ''}}
    {{($by == 'banjar') ? $reg->nama  . ' ' : ''}}
    {{date('d/m/Y')}}
@endsection

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
            <button class="btn btn-lg btn-primary float-right d-print-none" onclick="window.print()">Print</button>
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
                    return data.length > 30 ? data.substr(0,30) + '...' : data
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