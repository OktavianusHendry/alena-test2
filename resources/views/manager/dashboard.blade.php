@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-bold mb-4">Manager Dashboard</h1>

                <!-- Statistik Cepat -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                    <div class="p-4 bg-blue-50 rounded-lg">
                        <p class="text-sm text-gray-600">Total Karyawan</p>
                        <p class="text-2xl font-bold">150</p>
                    </div>
                    <div class="p-4 bg-green-50 rounded-lg">
                        <p class="text-sm text-gray-600">Tugas Selesai</p>
                        <p class="text-2xl font-bold">89%</p>
                    </div>
                </div>

                <!-- Menu Manager -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('manager.karyawan') }}" class="p-4 bg-purple-100 rounded-lg hover:bg-purple-200 transition">
                        <h3 class="font-semibold text-purple-800">👥 Kelola Karyawan</h3>
                        <p class="text-sm text-gray-600 mt-2">Manajemen data karyawan</p>
                    </a>

                    <a href="{{ route('manager.laporan') }}" class="p-4 bg-yellow-100 rounded-lg hover:bg-yellow-200 transition">
                        <h3 class="font-semibold text-yellow-800">📊 Laporan Kinerja</h3>
                        <p class="text-sm text-gray-600 mt-2">Analisis produktivitas tim</p>
                    </a>
                </div>

                <!-- Notifikasi Penting -->
                <div class="mt-6 p-4 bg-red-50 rounded-lg">
                    <h3 class="font-semibold text-red-800">⚠️ Peringatan</h3>
                    <p class="text-sm mt-2">3 tugas mendekati deadline</p>
                </div>

                <!-- Logout Button -->
                <div class="mt-8">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800">
                            🚪 Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection