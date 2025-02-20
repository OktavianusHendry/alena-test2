@extends(Auth::user()->role_as == '1' ? 'layouts.template' 
    : (Auth::user()->karyawan->jabatan == '10' ? 'layoutstaf.template' 
    : 'layoutss.template'))

@section('content')
<div class="container">
    <h2>Daftar Pengajuan Cuti</h2>
    <a href="{{ route('laporan_cuti_new.create') }}" class="btn btn-primary">Ajukan Cuti</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Karyawan</th>
                <th>Jenis Cuti</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Persetujuan Direktur</th>
                <th>Persetujuan Manager</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cuti as $c)
            <tr>
                <td>{{ $c->karyawan->nama }}</td>
                <td>{{ $c->jenisCuti->nama_cuti }}</td>
                <td>{{ $c->tanggal_mulai }}</td>
                <td>{{ $c->tanggal_selesai }}</td>
                <td>{{ $c->approved_by_director }}</td>
                <td>{{ $c->approved_by_manager }}</td>
                <td>
                    <a href="{{ route('laporan_cuti_new.edit', $c->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('laporan_cuti_new.destroy', $c->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
