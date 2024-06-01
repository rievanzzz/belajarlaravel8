@extends('layout.v_template')
@section('title', 'Siswa')

@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Mata Pelajaran</th>
                <th>Foto Siswa</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; ?>
            @foreach ($siswa as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->nis }}</td>
                    <td>{{ $data->nama_siswa }}</td>
                    <td>{{ $data->kelas }}</td>
                    <td>{{ $data->mapel }}</td>
                    <td><img src="{{ url('foto_siswa/' . $data->foto_siswa) }}" width="100px"></td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection