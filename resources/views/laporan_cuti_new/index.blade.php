@extends(Auth::user()->role_as == '1' ? 'layouts.template' 
    : (Auth::user()->karyawan->jabatan == '10' ? 'layoutstaf.template' 
    : 'layoutss.template'))

@section('content')
<div id="app">
    <div class="container-xxl flex-grow-1 container-p-y">
        <main class="py-4">
            <div class="d-flex justify-content-between mb-2">
                <h2 class="fw-bold py-3 mb-1">
                    <b>Data Pengajuan Cuti</b>
                    <span class="text-muted fw-light">/ Riwayat Pengajuan Cuti</span>
                </h2>
            </div>

            <div class="card mb-4">
                <div class="container">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Divisi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laporanCuti as $cuti)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $cuti->users->name }}</td>
                                        <td>{{ $cuti->divisi->kode_divisi ?? 'Tidak tersedia' }}</td>
                                        <td>
                                            <span class="badge bg-{{ $cuti->status == 'approved' ? 'success' : ($cuti->status == 'rejected' ? 'danger' : 'warning') }}">
                                                {{ ucfirst($cuti->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('laporan_cuti.show', $cuti->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                            <a href="{{ route('laporan_cuti.edit', $cuti->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('laporan_cuti.destroy', $cuti->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus laporan ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $laporanCuti->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection

