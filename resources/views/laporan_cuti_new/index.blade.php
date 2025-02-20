@extends(Auth::user()->role_as == '1' ? 'layouts.template' 
    : (Auth::user()->karyawan->jabatan == '10' ? 'layoutstaf.template' 
    : 'layoutss.template'))

@section('content')
    <div id="app">
        <div class="container-xxl flex-grow-1zz container-p-y">
            <main class="py-4">
                <div class="d-flex justify-content-between mb-2">
                    @if (Auth::user()->role_as == '1')
                        <h2 class="fw-bold py-3 mb-1">
                            <b>Data Pengajuan Cuti</b>
                            <span class="text-muted fw-light">/ Manajemen Riwayat Pengajuan Cuti Karyawan</span>
                        </h2>
                    @else
                        <h2 class="fw-bold py-3 mb-1">
                            <b>Data Ajukan Cuti</b>
                            <span class="text-muted fw-light">/ Form Pengajuan</span>
                        </h2>
                    @endif
                </div>

                @if (Auth::user()->role_as == '1')
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text">Tanggal Awal</span>
                                <input type="date" class="form-control" name="tglawal" id="tglawal" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text">Tanggal Akhir</span>
                                <input type="date" class="form-control" name="tglakhir" id="tglakhir" required />
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button href="javascript:void(0)" onclick="validateAndPrint()"
                                class="btn btn-primary rounded-pill">
                                Cetak Laporan <i class="bx bxs-printer"></i>
                            </button>
                        </div>
                    </div>
                @endif

                <div class="card mb-4">
                    <div class="container">
                        <div class="d-flex justify-content-between mb-3">
                            <a href="{{ route('laporan_cuti_new.create') }}">
                                <button type="button" class="btn rounded-pill btn-primary mt-3 align-content-center">
                                    <i class="menu-icon tf-icons bx bxs-plus-circle"></i> Tambah
                                </button>
                            </a>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('laporan_cuti_new.index') }}" method="GET" class="mb-3">
                            <div class="form-group d-flex">
                                <input type="text" name="search" value="{{ request()->input('search') }}"
                                    class="form-control" placeholder="Cari laporan cuti...">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </form>

                        @if ($laporanCutis->count() > 0)
                            <div class="table-responsive text-nowrap">
                                <br>
                                <table class="table table-hover align-content-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Karyawan</th>
                                            <th>Divisi</th>
                                            <th>Status</th>
                                            <th>Status</th>
                                            <th>Catatan</th>
                                            @if (Auth::user()->role_as == 1)
                                                <!-- Hanya admin -->
                                                <th>Aksi</th>
                                            @else
                                                <th>Aksi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($laporanCutiNew as $cuti)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $cuti->karyawan->name_lengkap }}</td>
                                                <td>{{ $cuti->divisi->kode_divisi ?? 'Tidak tersedia' }}</td>
                                                <td>{{ $cuti->approved_by_director}}</td>
                                                <td>{{ $cuti->approved_by_manager}}</td>
                                                <td>
                                                    <a href="{{ route('laporan_cuti_new.show', $cuti->id) }}"
                                                        class="btn btn-info btn-sm">
                                                        &nbsp;<i class="menu-icon tf-icons bx bxs-detail"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="{{ route('laporan_cuti_new.edit', $cuti->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        &nbsp;<i class="menu-icon tf-icons bx bx-edit"></i>
                                                    </a>&nbsp;&nbsp;
                                                    <form action="{{ route('laporan_cuti_new.destroy', $cuti->id) }}" method="POST"
                                                        style="display:inline;"
                                                        onsubmit="return confirm('Yakin ingin menghapus?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            &nbsp; <i class="menu-icon tf-icons bx bx-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center my-4 pagination-wrapper">
                                {{ $laporanCutiNew->appends(['search' => request()->input('search')])->links('pagination::bootstrap-4') }}
                            </div>
                        @else
                            <div class="alert alert-info">
                                Tidak ada data laporan cuti ditemukan.
                            </div>
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection