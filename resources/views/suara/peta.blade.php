@extends('app-report')

@section('title')
    {{'Suara] '}}
@endsection

@section('content')
		<div class="my-3 clearfix">
            <span class="h3 float-left">
                Tabel Suara
                <hr class="mb-0" />
            </span>
            <button class="btn btn-lg btn-primary float-right d-print-none" onclick="window.print()">Print</button>
		</div>
    <table class="table table-bordered" id="main-table">
        <thead>
            <tr>
                <td colspan="2"></td>
                @foreach ($cols as $col)
                    <th width="10%">{{$col->nama}}</th>
                @endforeach
                <th width="10%">Total</th>
            </tr>
            @foreach($data as $dt)
            <tr>
                @if(isset($dt['idpartai']))
                <th colspan='2'>
                    @if (isset($dt['lambang']) && $dt['lambang'] != null)
                        <img src="/storage/{{$dt['lambang']}}" width="25" height="25"  class="mr-2">
                    @endif
                    {{$dt['nourut']}}. {{$dt['nama']}}
                </th>
                    @foreach ($cols as $col)
                        <td></td>
                    @endforeach
                    <td></td>
                @else
                <td>{{$dt['nourut']}}</td>
                <td>
                    @if (isset($dt['foto']) && $dt['foto'] != null)
                        <img src="/storage/{{$dt['foto']}}" width="50" class="mr-2">
                    @endif
                    {{$dt['nama']}}
                </td>
                    <?php $tot = 0 ?>
                    @foreach($dt['suara'] as $dts)
                        <td align="right">{{$dts->suara}}</td>
                        <?php $tot+= $dts->suara; ?>
                    @endforeach
                    <td align="right">{{$tot}}</td>
                @endif
            </tr>
            @endforeach
        </thead>
    </table>
@stop