@extends('app-report')

@section('title')
    {{ucwords($reg)}}]
@endsection

@section('content')
    <div class="container-fluid">
        <div class="my-3 clearfix">
            <span class="h3 float-left">
                Laporan {{ucwords($reg)}}
                <h2></h2>
                <hr class="mb-0" />
            </span>
            <button class="btn btn-lg btn-primary float-right d-print-none" onclick="window.print()">Print</button>
        </div>
        <table class="table table-bordered" id="main-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th width="20">No</th>
                    <th>{{ucfirst($reg)}}</th>
                    <th>Koor Utama</th>
                    <th>Asisten</th>
                    <th>Pemilih</th>
                </tr>
            </thead>
            @if ($reg == 'harian')
            <tfoot>
                <tr>
                    <th colspan="3" align="right">Total : </th>
                    <th>{{App\Koorl1::count()}}</th>
                    <th>{{App\Koorl2::count()}}</th>
                    <th>{{App\Pemilih::count()}}</th>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
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
        processing: true,
        serverSide: true,
        ajax: '{{$mtableref}}',
        aoColumns: [
            { data: 'id', name: 'id', visible: false, orderable: false, searchable: false,
                render: function(data, type, row, meta) {
                    if (data == null) return -1;
                    return data;
                }
            },
            { 
                mdata: 'num', name: 'num', searchable: false,
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            { data: 'nama', name: 'nama', 
                render: function(data, type, row, meta) {
                    if ('{{$reg}}' != 'desa') return data;
                    return `<a href="stats/{{$reg}}/${row.id}" style="display:block">${data}</a>`
                }
            },
            { data: 'l1n', name: 'l1n',
                render: function(data, type, row, meta) {
                    if (data == null)  return 0;
                    if (row.id == null) return data;
                    return `<a href="/koorl1/{{$reg}}/${row.id}" style="display:block">${data}</a>`
                }
            },
            { data: 'l2n', name: 'l2n',
                render: function(data, type, row, meta) {
                    if (data == null)  return 0;
                    if (row.id == null) return data;
                    return `<a href="/koorl2/{{$reg}}/${row.id}" style="display:block">${data}</a>`
                }
            },
            { data: 'pn', name: 'pn',
                render: function(data, type, row, meta) {
                    if (data == null)  return 0;
                    if (row.id == null) return data;
                    return `<a href="/pemilih/{{$reg}}/${row.id}" style="display:block">${data}</a>`
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