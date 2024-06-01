@extends('layout.v_template')
@section('title', 'Koperasi')

@section('content')
    <a href="/koperasi/print" target="_blank" class="btn btn-primary">Print To Printer</a>
    <a href="/koperasi/printpdf" target="_blank" class="btn btn-success">Print To PDF</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>No. Faktur</th>
                <th>Pelanggan</th>
                <th>Tanggal</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; ?>
            @foreach ($koperasi as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->nomor_faktur }}</td>
                    <td>{{ $data->pelanggan }}</td>
                    <td>{{ $data->tanggal }}</td>
                    <td>{{ $data->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection