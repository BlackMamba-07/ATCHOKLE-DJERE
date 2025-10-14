<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier un membre</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="page-bg">
    <div class="app-container">
        <div class="mb-6">
            <h1 class="form-title">Modifier le membre</h1>
            <p class="form-subtitle">Mettez à jour les informations du membre.</p>
        </div>

        @if ($errors->any())
        <div class="bg-red-50 text-red-700 p-3 mb-4 rounded">
            <ul class="list-disc pl-6">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('members.update', $member->id) }}" method="post" enctype="multipart/form-data" class="surface-card p-6 form-grid">
            @csrf
            @method('PATCH')

            <div class="form-grid form-grid-2">
                <div>
                    <label class="labelF">Nom</label>
                    <input type="text" name="last_name" value="{{ old('last_name', $member->last_name) }}" class="input-green" required>
                </div>
                <div>
                    <label class="labelF">Prénoms</label>
                    <input type="text" name="first_names" value="{{ old('first_names', $member->first_names) }}" class="input-green" required>
                </div>
            </div>

            <div>
                <label class="labelF">Fonction</label>
                <input type="text" name="position_title" value="{{ old('position_title', $member->position_title) }}" class="input-green">
            </div>

            <div class="form-grid form-grid-2">
                <div>
                    <label class="labelF">Numéro d'adhérent</label>
                    <input type="text" name="member_number" value="{{ old('member_number', $member->member_number) }}" class="input-green" required>
                </div>
                <div>
                    <label class="labelF">Année d'adhésion</label>
                    <input type="number" name="join_year" value="{{ old('join_year', $member->join_year) }}" class="input-green" required>
                </div>
            </div>

            <div>
                <label class="labelF">Photo</label>
                <input type="file" name="photo" accept="image/*" class="input-green">
                @if ($member->photo_path)
                <p class="help-text mt-1">Photo actuelle : <a href="{{ asset('storage/' . $member->photo_path) }}" target="_blank" class="underline">voir</a></p>
                @endif
            </div>

            <div class="flex items-center gap-3 mt-6">
                <button class="btn-primary-solid">Mettre à jour</button>
                <a href="{{ route('members.index') }}" class="btn-ghost">Annuler</a>
            </div>
        </form>
    </div>
</body>

</html>


