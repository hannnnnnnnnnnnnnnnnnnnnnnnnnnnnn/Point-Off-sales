<!-- dashboard.blade.php -->
@extends('layouts.admin')  <!-- Panggil layout utama -->

@section('content')
    <div class="admin-dashboard">
        @include('layouts.sidebar')  <!-- Panggil sidebar di sini -->

        <div class="dashboard-content">
            <h1>Welcome to the Admin Dashboard</h1>
            <!-- Konten dashboard admin lainnya -->
        </div>
    </div>
@endsection
