@extends('app')

@section('content')
    <div class="container">
        @if ($reg == 'harian')
        <a class="btn btn-lg btn-primary float-right ml-2" href="/stats/{{$reg}}/report">Report</a>
        @endif
        <table class="table table-bordered" id="main-table">
            <thead>
                <tr>
                	<th>ID</th>
                    <th width="20">No</th>
                    <th>Desa</th>
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
        lengthMenu: [ [-1], ["All"] ],
        // lengthMenu: [ 10 ],
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
            { data: 'desa', name: 'desa', 
                render: function(data, type, row, meta) {
                    return data;
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
});
</script>
@endpush
