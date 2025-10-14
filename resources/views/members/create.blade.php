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
    <div class="mb-6">
        <h1 class="form-title">Formulaire d'adhésion</h1>
        <p class="form-subtitle">Renseignez les informations du membre à créer.</p>
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
    <form action="{{ route('members.store') }}" method="post" enctype="multipart/form-data" class="surface-card p-6 form-grid">
        @csrf
        <div class="form-grid form-grid-2">
            <div>
                <label class="labelF">Nom</label>
                <input type="text" name="last_name" value="{{ old('last_name') }}" class="input-green" placeholder="Ex: YAO" required>
            </div>
            <div>
                <label class="labelF">Prénoms</label>
                <input type="text" name="first_names" value="{{ old('first_names') }}" class="input-green" placeholder="Ex: DE JACQUES JEAN B." required>
            </div>
        </div>
        <div>
            <label class="labelF">Fonction</label>
            <input type="text" name="position_title" value="{{ old('position_title') }}" class="input-green" placeholder="Ex: SCOM">
            <!-- <p class="help-text">Intitulé en majuscules si possible.</p> -->
        </div>
        <div class="form-grid form-grid-2">
            <div>
                <label class="labelF">Numéro d'adhérent</label>
                <input type="text" name="member_number" value="{{ old('member_number') }}" class="input-green" placeholder="Ex: 002251209" required>
            </div>
            <div>
                <label class="labelF">Année d'adhésion</label>
                <input type="number" name="join_year" value="{{ old('join_year', date('Y')) }}" class="input-green" required>
            </div>
        </div>
        <div>
            <label class="labelF">Photo</label>
            <div id="photo-dropzone" class="dropzone">
                <div class="dz-instructions">Glissez-déposez une photo ici ou cliquez pour choisir</div>
                <div class="dz-hint">PNG/JPG jusqu’à 2 Mo — format portrait recommandé</div>
                <img id="photo-preview" class="preview-image mt-3 hidden" alt="Aperçu">
                <input id="photo-input" type="file" name="photo" accept="image/*" class="w-px h-px overflow-hidden absolute opacity-0" tabindex="-1">
            </div>
        </div>
        <div class="flex items-center gap-3">
            <button class="btn-primary-solid">Enregistrer</button>
            <a href="{{ route('members.index') }}" class="btn-ghost">Annuler</a>
        </div>
    </form>
    <script>
        (function(){
            const dz = document.getElementById('photo-dropzone');
            const input = document.getElementById('photo-input');
            const preview = document.getElementById('photo-preview');
            function showPreview(file){
                if (!file) return;
                const reader = new FileReader();
                reader.onload = e => { preview.src = e.target.result; preview.classList.remove('hidden'); };
                reader.readAsDataURL(file);
            }
            dz.addEventListener('click', () => input.click());
            dz.addEventListener('dragover', (e) => { e.preventDefault(); dz.classList.add('dragover'); });
            dz.addEventListener('dragleave', () => dz.classList.remove('dragover'));
            dz.addEventListener('drop', (e) => { e.preventDefault(); dz.classList.remove('dragover'); const f = e.dataTransfer.files && e.dataTransfer.files[0]; if (f) { input.files = e.dataTransfer.files; showPreview(f); } });
            input.addEventListener('change', () => { const f = input.files && input.files[0]; showPreview(f); });
        })();
    </script>
</div>
</body>
</html>

