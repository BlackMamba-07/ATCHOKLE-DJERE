<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="page-bg">
<div class="app-container">
    <header class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Dashboard</h1>
        <nav class="flex items-center gap-3">
            <a href="{{ route('home') }}" class="btn-ghost">Accueil</a>
            <a href="{{ route('members.create') }}" class="btn-primary-solid">Ajouter</a>
        </nav>
    </header>

    @if (session('status'))
        <div class="bg-green-50 text-green-800 p-3 rounded mb-4">{{ session('status') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse ($members as $member)
            <div class="surface-card p-4">
                <div class="w-full h-48 rounded overflow-hidden mb-3 bg-white/5 ring-1 ring-white/10">
                    @if ($member->photo_path)
                        <img src="{{ asset('storage/'.$member->photo_path) }}" alt="photo" class="w-full h-full object-cover">
                    @endif
                </div>
                <h3 class="font-semibold">{{ $member->last_name }} {{ $member->first_names }}</h3>
                <p class="text-sm muted">{{ $member->position_title }}</p>
                <p class="text-sm">N° adhérent: <strong>{{ $member->member_number }}</strong></p>
                <p class="text-sm">Année: {{ $member->join_year }}</p>
            </div>
        @empty
            <p class="muted">Aucun membre pour le moment.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $members->links() }}
    </div>
</div>
</body>
</html>

