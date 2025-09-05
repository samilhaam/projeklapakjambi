@php
    $user = Auth::user();
@endphp

<nav class="bg-white shadow p-4">
    <div class="container mx-auto flex justify-between">
        <div class="font-bold">Marketplace</div>
        <div class="space-x-4">
            @if ($user->hasRole('pembeli'))
                <a href="{{ route('pembeli.dashboard') }}">Dashboard Pembeli</a>
            @elseif ($user->hasRole('pelaku_umkm'))
                <a href="{{ route('pelaku_umkm.dashboard') }}">Dashboard Pelaku UMKM</a>
            @elseif ($user->hasRole('admin'))
                <a href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
            @endif
            <a href="{{ route('profile.edit') }}">Profil</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-red-500">Logout</button>
            </form>
        </div>
    </div>
</nav>
