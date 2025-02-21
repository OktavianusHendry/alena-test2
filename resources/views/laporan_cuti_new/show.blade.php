@extends(Auth::user()->role_as == '1' ? 'layouts.template' 
    : (Auth::user()->karyawan->jabatan == '10' ? 'layoutstaf.template' 
    : 'layoutss.template'))

@section('content')
    <div id="app">
        <div class="container-xxl flex-grow-1zz container-p-y">
            <main class="py-4">
                <div class="d-flex justify-content-between mb-2">
                    <h2 class="fw-bold py-3 mb-1">
                        <b>Detail Laporan Cuti</b>
                    </h2>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Informasi Laporan Cuti</h5>
                        <hr>
                        <div class="mb-3">
                            <strong>Nama Karyawan:</strong>
                            <p>{{ $laporanCutis->karyawan->nama_lengkap }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Divisi:</strong>
                            <p>{{ $laporanCutis->karyawan->divisi ?? 'Tidak tersedia' }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Jenis Cuti:</strong>
                            <p>{{ $laporanCutis->jenis_cuti ? $laporanCutis->jenis_cuti->nama_jenis_cuti : 'Tidak tersedia' }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Tanggal Pengajuan:</strong>
                            <p>{{ $laporanCutis->created_at ? $laporanCutis->created_at->format('d-m-Y') : 'Tidak tersedia' }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Tanggal Mulai:</strong>
                            <p>{{ $laporanCutis->tanggal_mulai ? $laporanCutis->tanggal_mulai->format('d-m-Y') : 'Tidak tersedia' }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Tanggal Selesai:</strong>
                            <p>{{ $laporanCutis->tanggal_selesai ? $laporanCutis->tanggal_selesai->format('d-m-Y') : 'Tidak tersedia' }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Alasan:</strong>
                            <p>{{ $laporanCutis->alasan }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Status Persetujuan Direktur:</strong>
                            <p>{{ $laporanCutis->approved_by_director }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Status Persetujuan Manajer:</strong>
                            <p>{{ $laporanCutis->approved_by_manager }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Catatan:</strong>
                            <p>{{ $laporanCutis->catatan ?? 'Tidak ada catatan' }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Aksi:</strong>
                                <a href="{{ route('laporan_cuti_new.index') }}" class="btn btn-warning">Kembali</a>
                                <a href="{{ route('laporan_cuti_new.edit', $laporanCutis->id) }}" class="btn btn-info">Edit</a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection