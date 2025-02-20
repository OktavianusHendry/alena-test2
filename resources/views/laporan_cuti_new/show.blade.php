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
                    <a href="{{ route('laporan_cuti_new.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Informasi Laporan Cuti</h5>
                        <hr>
                        <div class="mb-3">
                            <strong>Nama Karyawan:</strong>
                            <p>{{ $laporanCuti->karyawan->name_lengkap }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Divisi:</strong>
                            <p>{{ $laporanCuti->karyawan->divisi->kode_divisi ?? 'Tidak tersedia' }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Jenis Cuti:</strong>
                            <p>{{ $laporanCuti->jenisCuti->nama_jenis_cuti }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Tanggal Pengajuan:</strong>
                            <p>{{ $laporanCuti->tanggal_pengajuan->format('d-m-Y') }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Tanggal Mulai:</strong>
                            <p>{{ $laporanCuti->tanggal_mulai->format('d-m-Y') }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Tanggal Selesai:</strong>
                            <p>{{ $laporanCuti->tanggal_selesai->format('d-m-Y') }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Alasan:</strong>
                            <p>{{ $laporanCuti->alasan }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Status Persetujuan Direktur:</strong>
                            <p>{{ $laporanCuti->approved_by_director }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Status Persetujuan Manajer:</strong>
                            <p>{{ $laporanCuti->approved_by_manager }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Catatan:</strong>
                            <p>{{ $laporanCuti->catatan ?? 'Tidak ada catatan' }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Aksi:</strong>
                                <a href="{{ route('laporan_cuti_new.index') }}" class="btn btn-warning">Kembali</a>
                                <a href="{{ route('laporan_cuti_new.edit', $laporanCuti->id_surat) }}" class="btn btn-info">Edit</a>
                                @if (user()->karyawan->jabatan == '15' || Auth::user()->role_as == '1')
                                    <a href="{{ route('laporan_cuti_new.validasi', $laporanCuti->id_surat) }}" class="btn btn-success">Format ASN</a>   
                                @endif
                                @if (Auth::user()->karyawan->jabatan == '14' || Auth::user()->role_as == '1')
                                    <a href="{{ route('laporan_cuti_new.validasi', $laporanCuti->id_surat) }}" class="btn btn-success">Format ASN</a>   
                                @endif
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection