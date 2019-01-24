@extends('app')

@section('content')
    <div class="container">
        <table class="table table-bordered" id="main-table">
            <thead>
                <tr>
                	<th>ID</th>
                    <th width="20">No</th>
                    <th>Koor Utama</th>
                    <th>Asisten</th>
                    <th>Pemilih</th>
                    <th>Total</th>
                </tr>
            </thead>
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
            { data: 'id', name: 'id', visible: false, orderable: false, searchable: false },
            { 
                mdata: 'num', name: 'num',  
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            { data: 'namalengkap', name: 'namalengkap'},
            { data: 'l2n', name: 'l2n',
                render: function(data, type, row, meta) {
                    if (data == null)  return 0;
                    return `<a href="/koorl2/koorl1/${row.id}" style="display:block">${data}</a>`
                }
            },
            { data: 'pn', name: 'pn',
                render: function(data, type, row, meta) {
                    if (data == null)  return 0;
                    return `<a href="/pemilih/koorl1/${row.id}" style="display:block">${data}</a>`
                } 
            },
            { data: 'total', name: 'total'},
        ],
    });
});
</script>
@endpush
