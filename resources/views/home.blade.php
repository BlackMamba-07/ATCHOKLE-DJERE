<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accueil</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style> body{margin:0} </style>
</head>
<body class="page-bg">
    <header class="mx-auto max-w-7xl px-6 py-5 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="h-9 w-9 rounded-md bg-white/10 ring-1 ring-white/10 grid place-items-center">
                <span class="text-white">🌵</span>
            </div>
            <div class="leading-tight">
                <p class="text-xs tracking-widest text-white/70">1991 - 2000</p>
                <p class="font-semibold">Atchokré Djéré</p>
            </div>
        </div>
        <nav class="hidden md:flex items-center gap-8 text-sm text-white/80">
            <a href="{{ route('home') }}" class="hover:text-white">Accueil</a>
            <a href="#catalogue" class="hover:text-white">A propos</a>
            <a href="#promos" class="hover:text-white">Contacts</a>
            <a href="{{ route('members.index') }}" class="hover:text-white">Dashboard</a>
        </nav>
        <div class="flex items-center gap-3">
            @auth
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="rounded-full bg-white/10 hover:bg-white/20 px-4 py-2 text-sm">Se déconnecter</button>
            </form>
            @else
            <a href="{{ route('login') }}" class="rounded-full bg-white/10 hover:bg-white/20 px-4 py-2 text-sm">Connexion</a>
            <a href="{{ route('register') }}" class="rounded-full bg-lime-400 text-emerald-950 hover:bg-lime-300 px-4 py-2 text-sm font-semibold">Inscription</a>
            @endauth
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-6 pb-14">
        <section class="relative grid grid-cols-1 lg:grid-cols-2 gap-10 items-center rounded-2xl overflow-hidden bg-gradient-to-r from-emerald-900/60 to-lime-700/40 ring-1 ring-white/10">
            <div class="p-10 md:p-14">
                <p class="uppercase tracking-[0.3em] text-white/70 text-sm mb-3">1991-2000</p>
                <h1 class="text-6xl md:text-7xl lg:text-8xl font-extrabold leading-none">BIENVENU</h1>
                <p class="mt-6 text-white/80 max-w-xl">Atchokré Djere est un portail ou vous pouvez ajouter des membres via un formulaire.</p>
                <div class="mt-8 flex items-center gap-4">
                    <a href="#catalogue" class="inline-flex items-center gap-2 rounded-full bg-lime-400 text-emerald-950 hover:bg-lime-300 px-5 py-3 font-semibold">Se connecter</a>
                    <a href="{{ route('members.create') }}" class="inline-flex items-center rounded-full bg-white/10 hover:bg-white/20 px-5 py-3">Ajouter un membre</a>
                </div>
            </div>
            <div class="relative">
                <div class="absolute -inset-y-10 -right-10 hidden lg:block w-1/2 rounded-l-[48px] bg-lime-200/20"></div>
                <img src="https://images.unsplash.com/photo-1520697830682-bbb6e85e2f5e?q=80&w=1600&auto=format&fit=crop" alt="Logo" class="relative z-10 w-full h-[520px] object-cover lg:h-[640px] lg:object-contain">
            </div>
        </section>
    </main>
</body>
</html>

