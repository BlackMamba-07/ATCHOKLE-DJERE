<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajouter un membre</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="page-bg">
<div class="app-container">
    <h1 class="text-2xl font-semibold mb-4">Formulaire d'adhésion</h1>
    @if ($errors->any())
        <div class="bg-red-50 text-red-700 p-3 mb-4 rounded">
            <ul class="list-disc pl-6">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('members.store') }}" method="post" enctype="multipart/form-data" class="surface-card p-6 space-y-4">
        @csrf
        <div>
            <label class="label">Nom</label>
            <input type="text" name="last_name" value="{{ old('last_name') }}" class="input-green" required>
        </div>
        <div>
            <label class="label">Prénoms</label>
            <input type="text" name="first_names" value="{{ old('first_names') }}" class="input-green" required>
        </div>
        <div>
            <label class="label">Fonction</label>
            <input type="text" name="position_title" value="{{ old('position_title') }}" class="input-green">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="label">Numéro d'adhérent</label>
                <input type="text" name="member_number" value="{{ old('member_number') }}" class="input-green" required>
            </div>
            <div>
                <label class="label">Année d'adhésion</label>
                <input type="number" name="join_year" value="{{ old('join_year', date('Y')) }}" class="input-green" required>
            </div>
        </div>
        <div>
            <label class="label">Photo</label>
            <input type="file" name="photo" accept="image/*" class="w-full text-white">
        </div>
        <div class="flex items-center gap-3">
            <button class="btn-primary-solid">Enregistrer</button>
            <a href="{{ route('members.index') }}" class="btn-ghost">Annuler</a>
        </div>
    </form>
</div>
</body>
</html>

