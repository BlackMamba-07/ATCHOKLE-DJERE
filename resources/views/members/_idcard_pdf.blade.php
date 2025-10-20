<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aperçu carte</title>
    <style>
        body { font-family: 'Poppins', system-ui, sans-serif; margin: 0; background: #f5f7f6; color:#1D503A; }
        .page { display: grid; place-items: center; min-height: 100vh; padding: 24px; }
        .preview { background: #fff; padding: 16px; border-radius: 16px; box-shadow: 0 6px 18px rgba(0,0,0,0.08); }
        .actions { margin-top: 16px; display: flex; gap: 8px; justify-content: center; }
        .btn { border: 1px solid #1D503A; color:#1D503A; background:#fff; padding: 10px 14px; border-radius: 10px; text-decoration: none; font-weight:600; }
        .btn-primary { background:#1D503A; color:#fff; }
    </style>
</head>
<body>
    <div class="page">
        <div>
            <div class="preview">
                @include('members.idcard_pdf', ['member' => $member])
            </div>
            <div class="actions">
                <a class="btn" href="{{ url()->previous() }}">Annuler</a>
                <a class="btn btn-primary" href="{{ route('members.print', $member->id) }}">Confirmer l'impression (PDF)</a>
            </div>
        </div>
    </div>
</body>
</html>

