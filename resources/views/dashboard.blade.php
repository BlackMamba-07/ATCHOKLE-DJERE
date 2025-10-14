<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="page-bg">
    <main class="mx-auto max-w-5xl px-6 py-10">
        <h1 class="text-3xl font-bold mb-6">Dashboard</h1>
        <div class="grid gap-4">
            <a href="{{ route('members.index') }}" class="inline-flex items-center justify-center rounded-lg bg-white/10 hover:bg-white/20 px-4 py-3">Aller à la liste des membres</a>
            <a href="{{ route('members.create') }}" class="inline-flex items-center justify-center rounded-lg bg-lime-400 text-emerald-950 hover:bg-lime-300 px-4 py-3 font-semibold">Ajouter un membre</a>
        </div>
    </main>
</body>
</html>


