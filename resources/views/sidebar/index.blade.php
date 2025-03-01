<aside class="w-64 bg-blue-900 text-white flex flex-col p-5 h-screen fixed top-0 left-0 overflow-y-auto">
    <h2 class="text-2xl font-bold mb-6">Admin Panel</h2>
    <nav class="space-y-2">
        <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 rounded hover:bg-blue-700">Dashboard</a>
        <a href="{{ route('products.index') }}" class="block py-2 px-4 rounded hover:bg-blue-700">Manajemen Produk</a>
        <a href="{{ route('rekap') }}" class="block py-2 px-4 rounded hover:bg-blue-700">Laporan</a>
        <a href="{{ route('users.index') }}" class="block py-2 px-4 rounded hover:bg-blue-700">Manajemen akun</a>
        
        <!-- Tombol Logout dengan Form -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="mt-2">
            @csrf
            <button type="submit" class="w-full text-left py-2 px-4 rounded bg-red-600 hover:bg-red-700">
                Logout
            </button>
        </form>
    </nav>
</aside>
