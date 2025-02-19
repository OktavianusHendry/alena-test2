@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-bold mb-4">Staff Dashboard</h1>
                
                <!-- Info Pengguna -->
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        @if(Auth::guard('karyawan')->user()->foto)
                            <img src="{{ asset('storage/' . Auth::guard('karyawan')->user()->foto) }}" 
                                 class="w-20 h-20 rounded-full mr-4" 
                                 alt="Foto Profil">
                        @else
                            <div class="w-20 h-20 bg-gray-200 rounded-full mr-4 flex items-center justify-center">
                                <span class="text-gray-500">No Photo</span>
                            </div>
                        @endif
                        
                        <div>
                            <h2 class="text-xl font-semibold">
                                {{ Auth::guard('karyawan')->user()->nama_lengkap }}
                            </h2>
                            <p class="text-gray-600">
                                NIP: {{ Auth::guard('karyawan')->user()->nip }}
                            </p>
                            <p class="text-gray-600">
                                Divisi: {{ Auth::guard('karyawan')->user()->divisi }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Menu Staff
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('staff.tugas') }}" class="p-4 bg-blue-100 rounded-lg hover:bg-blue-200 transition">
                        <h3 class="font-semibold text-blue-800">📋 Daftar Tugas</h3>
                        <p class="text-sm text-gray-600 mt-2">Lihat tugas yang harus diselesaikan</p>
                    </a>

                    <a href="{{ route('staff.profile') }}" class="p-4 bg-green-100 rounded-lg hover:bg-green-200 transition">
                        <h3 class="font-semibold text-green-800">👤 Profil Saya</h3>
                        <p class="text-sm text-gray-600 mt-2">Kelola informasi akun Anda</p>
                    </a>
                </div> -->

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