@extends('app')

@section('content')

    <div class="container">
        <form method="post" action="{{route('master.'.$reg.'.submit')}}">
            @csrf
            <div class="row my-3">
                <div class="form-group col-md-4 text-right">
                    @if ($data['id'] == '')
                    <h3 class="mt-4">Tambah Data {{ucfirst($reg)}} :</h3>
                    @else
                    <h3 class="mt-4">Ubah Data {{ucfirst($reg)}} [{{$data['nama']}}] :</h3>
                    @endif
                </div>
                <div class="form-group col-md-3">
                    <label class="form-label">{{ucfirst($reg)}}</label>
                    <input type="text" class="form-control" name="nama" value="{{$data['nama']}}">
                </div>
                <div class="form-group col-md-3">
                    <label class="form-label">{{ucfirst($parent)}}</label>
                    <select class="form-control" name="id{{$parent}}">
                        @foreach($pdata as $d)
                            @if ($data['id'.$parent] == $d['id'])
                                <option value="{{$d['id']}}" selected>{{$d['nama']}}</option>
                            @else
                                <option value="{{$d['id']}}">{{$d['nama']}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    @if ($data['id'] == '')
                    <button class="btn btn-lg btn-primary mt-4">Submit</button>
                    @else
                    <button class="btn btn-lg btn-primary mt-4">Update</button>
                    <button class="btn btn-lg btn-primary mt-4" type="button" onclick="window.location.href = '{{route('master.'.$reg)}}'">&lt;</button>
                    @endif
                </div>
            </div>
            <input type="hidden" name="id" value="{{$data['id']}}">
        </form>

        <table class="table table-bordered" id="main-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th width="20">No</th>
                    <th>{{ucfirst($reg)}}</th>
                    <th>{{ucfirst($parent)}}</th>
                    <th width="30">Action</th>
                </tr>
            </thead>
        </table>
    </div>
@stop

@push('scripts')
<script>
$(function() {
    var table = $('#main-table').DataTable({
        lengthMenu: [ 15 ],
        processing: true,
        serverSide: true,
        // searching: false,
        lengthChange: false,
        ajax: '{{$mtableref}}',
        aoColumns: [
            { data: 'id', name: 'id', visible: false, orderable: false, searchable: false },
            { 
                mdata: 'num', name: 'num',  
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            { data: 'nama', name: 'nama'},
            { data: '{{$parent}}.nama', name: '{{$parent}}.nama'},
            { 
                mdata: 'action', name: 'action', orderable: false, searchable: false,
                render: function(data, type, row, meta) {
                    return `
                    <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown">
                        Detail
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <form action="{{route($menu)}}/${row.id}" method="post" onsubmit="return confirm('Yakin ingin hapus data?');">
                          @csrf
                          @method('DELETE')
                            @if (Auth::user()->hasAccess('L1U'))
                            <button type="button" class="dropdown-item btn btn-info" id="main-edit" onclick="window.location = '{!! route($menu) !!}/${row.id}/edit'">Edit</button>
                            @endif
                            @if (Auth::user()->hasAccess('L1D'))
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
