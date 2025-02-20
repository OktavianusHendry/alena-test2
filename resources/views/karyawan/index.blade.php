@extends('layouts.template')

@section('content')
    <div id="app">
        <div class="container-xxl flex-grow-1 container-p-y">
            <main class="py-4">
                <div class="d-flex justify-content-between mb-2">
                    <h2 class="fw-bold py-3 mb-1">
                        <b>Data Karyawan</b>
                        <span class="text-muted fw-light">/ Manajemen Data Karyawan</span>
                    </h2>
                </div>
                <div class="card mb-4">
                    <br>
                    <div class="container">
                    @if (Auth::user()->role_as == '2' || Auth::user()->role_as == '1')
                            <div class="d-flex justify-content-between mb-3">
                                <a href="{{ route('karyawan.create') }}">
                                    <button type="button" class="btn rounded-pill btn-primary mt-3 align-content-center">
                                        <i class="menu-icon tf-icons bx bxs-plus-circle"></i>Tambah
                                    </button>
                                </a>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('karyawan.index') }}" method="GET" class="mb-3">
                            <div class="form-group d-flex">
                                <input type="text" name="search" value="{{ request()->input('search') }}"
                                    class="form-control" placeholder="Cari Karyawan...">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </form>

                        @if ($karyawans->count() > 0)
                            <div class="table-responsive text-nowrap">
                                <br>
                                <table class="table table-hover align-content-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Jabatan</th>
                                            <th>Divisi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-1 align-content-center">
                                        @foreach ($karyawans as $karyawan)
                                            <tr>
                                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                    <strong>{{ $loop->iteration }}</strong>
                                                </td>
                                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                    <strong>{{ $karyawan->nama_lengkap }}</strong>
                                                </td>
                                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                    <strong>{{ $karyawan->divisi ?? 'Divisi tidak tersedia' }}</strong>
                                                </td>
                                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                    <strong>
                                                        @if ($karyawan->jabatan == '10')
                                                            <button
                                                                class="btn btn-success btn-sm disabled">&nbsp;&nbsp;&nbsp;&nbsp;Staff&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                                        @elseif ($karyawan->jabatan == '11')
                                                            <button
                                                                class="btn btn-warning btn-sm disabled">Manager</button>
                                                        @elseif ($karyawan->jabatan == '13')
                                                            <button
                                                                class="btn btn-primary btn-sm disabled">&nbsp;&nbsp;&nbsp;Kepala LKP&nbsp;&nbsp;&nbsp;</button>
                                                        @elseif ($karyawan->jabatan == '14')
                                                            <button
                                                                class="btn btn-primary btn-sm disabled">&nbsp;&nbsp;&nbsp;Wakil Direktur&nbsp;&nbsp;&nbsp;</button>
                                                        @elseif ($karyawan->jabatan == '15')
                                                            <button
                                                                class="btn btn-primary btn-sm disabled">&nbsp;&nbsp;&nbsp;Direktur&nbsp;&nbsp;&nbsp;</button>
                                                        @endif
                                                    </strong>
                                                </td>
                                                <td>
                                                    <a href="{{ route('karyawan.show', $karyawan->id) }}"
                                                        class="btn btn-info btn-sm">
                                                        &nbsp;<i
                                                            class="menu-icon tf-icons bx bxs-detail"></i></a>&nbsp;&nbsp;
                                                    <a href="{{ route('karyawan.edit', $karyawan->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        &nbsp;<i class="menu-icon tf-icons bx bx-edit"></i>
                                                    </a>&nbsp;&nbsp;
                                                    <form action="{{ route('karyawan.destroy', $karyawan->id) }}" method="POST"
                                                        style="display:inline;"
                                                        onsubmit="return confirm('Yakin ingin menghapus?');">
                                                        <input type="hidden" name="_method" value="delete" />
                                                        {{ csrf_field() }}
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
                                {{ $karyawans->appends(['search' => request()->input('search')])->links('pagination::bootstrap-4') }}
                            </div>
                        @else
                            <div class="alert alert-info">
                                Tidak ada data Karyawan ditemukan.
                            </div>
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
