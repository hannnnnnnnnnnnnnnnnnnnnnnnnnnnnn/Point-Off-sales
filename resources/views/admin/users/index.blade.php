@extends('layouts.admin')

@section('content')
<style>
    /* Menghilangkan scroll sebelum layar penuh */
    body {
        overflow: hidden;
    }
</style>

<div class="pl-64 container mx-auto mt-2 p-2 min-h-screen flex flex-col">
    <h2 class="text-3xl font-bold text-blue-600 mb-4">Manajemen Akun</h2>

    <div class="flex justify-end">
        <a href="{{ route('users.create') }}" class="bg-blue-600 text-white px-3 py-1 rounded-lg shadow-md hover:bg-blue-700 transition">
            + Tambah Akun
        </a>
    </div>

    <!-- Tampilkan Admin -->
    <h3 class="text-2xl font-semibold text-gray-700 mt-4">Admin</h3>
    <div class="overflow-x-auto mt-2 flex-grow">
        <table class="w-full border border-gray-300 shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="p-3 border">Nama</th>
                    <th class="p-3 border">Email</th>
                    <th class="p-3 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users->where('role', 'admin') as $user)
                <tr class="hover:bg-gray-50">
                    <td class="p-3 border">{{ $user->name }}</td>
                    <td class="p-3 border">{{ $user->email }}</td>
                    <td class="p-3 border flex flex-wrap gap-2">
                        <a href="{{ route('users.edit', $user->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-md shadow hover:bg-yellow-600 transition">Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded-md shadow hover:bg-red-700 transition">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tampilkan Kasir -->
    <h3 class="text-2xl font-semibold text-gray-700 mt-6">Kasir</h3>
    <div class="overflow-x-auto mt-2 flex-grow">
        <table class="w-full border border-gray-300 shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="p-3 border">Nama</th>
                    <th class="p-3 border">Email</th>
                    <th class="p-3 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users->where('role', 'kasir') as $user)
                <tr class="hover:bg-gray-50">
                    <td class="p-3 border">{{ $user->name }}</td>
                    <td class="p-3 border">{{ $user->email }}</td>
                    <td class="p-3 border flex flex-wrap gap-2">
                        <a href="{{ route('users.edit', $user->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-md shadow hover:bg-yellow-600 transition">Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded-md shadow hover:bg-red-700 transition">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- SweetAlert2 untuk notifikasi akun berhasil dibuat -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    @endif
</script>
@endsection
