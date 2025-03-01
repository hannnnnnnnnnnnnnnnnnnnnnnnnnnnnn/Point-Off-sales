@extends('layouts.admin')

@section('content')
<div class="container mx-auto mt-5 p-5 flex justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
        <h2 class="text-3xl font-bold text-blue-600 mb-6 text-center">Tambah Akun</h2>

        <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block font-medium text-gray-700">Nama</label>
                <input type="text" name="name" required 
                       class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Email</label>
                <input type="email" name="email" required 
                       class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Password</label>
                <input type="password" name="password" required 
                       class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Peran</label>
                <select name="role" class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm">
                    <option value="admin">Admin</option>
                    <option value="kasir">Kasir</option>
                </select>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('users.index') }}" 
                class="bg-gray-500 text-white px-5 py-2  rounded-lg shadow-md hover:bg-gray-600 transition">
                 Kembali
                </a>

                <button type="submit" 
                        class="bg-green-600 text-white px-5 py-2 rounded-lg shadow-md hover:bg-green-700 transition">
                    Buat Akun
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
