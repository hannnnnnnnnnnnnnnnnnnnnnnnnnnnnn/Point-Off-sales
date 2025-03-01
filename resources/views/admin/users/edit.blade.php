@extends('layouts.admin')

@section('content')
<div class="container mx-auto mt-10 p-10 max-w-lg bg-white shadow-lg rounded-lg">
    <h2 class="text-3xl font-bold text-blue-600 mb-6 text-center">Edit Akun</h2>

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium text-gray-700">Nama</label>
            <input type="text" name="name" value="{{ $user->name }}" required 
                   class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm">
        </div>

        <div>
            <label class="block font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ $user->email }}" required 
                   class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm">
        </div>

        <div>
            <label class="block font-medium text-gray-700">Password <span class="text-gray-500">(Opsional)</span></label>
            <input type="password" name="password" 
                   class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm" 
                   placeholder="Kosongkan jika tidak ingin mengubah">
        </div>

        <div>
            <label class="block font-medium text-gray-700">Role</label>
            <select name="role" 
                    class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm">
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="kasir" {{ $user->role == 'kasir' ? 'selected' : '' }}>Kasir</option>
            </select>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('users.index') }}" 
               class="bg-gray-500 text-white px-5 py-2 rounded-lg shadow-md hover:bg-gray-600 transition">
                Kembali
            </a>
            
            <div class="flex gap-2">
                <button type="submit" 
                        class="bg-blue-600 text-white px-5 py-2 rounded-lg shadow-md hover:bg-blue-700 transition">
                    Simpan Perubahan
                </button>
            </div>
        </div>
        
    </form>
</div>
@endsection
