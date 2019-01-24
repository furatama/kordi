@extends('app')

@section('content')
    <div class="container">
        <table class="table table-bordered" id="main-table">
            <thead>
                <tr>
                	<th>ID</th>
                    <th width="20">No</th>
                    <th>Asisten</th>
                    <th>Pemilih</th>
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
            { data: 'pn', name: 'pn',
                render: function(data, type, row, meta) {
                    if (data == null)  return 0;
                    return `<a href="/pemilih/koorl2/${row.id}" style="display:block">${data}</a>`
                } 
            },
        ],
    });
});
</script>
@endpush
