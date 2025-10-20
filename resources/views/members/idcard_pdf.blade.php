<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carte Membre</title>
    <style>
        /* Page A6 avec marges de sécurité (pour PDF) */
        @page {
            size: A5;
            margin: 8mm;
        }

        html, body { padding: 0; margin: 0; height: 100%; }

        body {
            font-family: 'Poppins', system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
            background: #ffffff;
            color: #1D503A;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            box-sizing: border-box;
            overflow: hidden; /* évite le scroll en aperçu */
        }

        .idcard {
            width: {{ ($preview ?? false) ? '280px' : '340px' }};
            border-radius: 28px;
            overflow: hidden;
            background: #ffffff;
            color: #1D503A;
            border: 1px solid #E5E7EB;
            page-break-inside: avoid;
            margin: {{ ($preview ?? false) ? '12px auto' : '10mm auto' }};
        }

        /* En-tête vert clair avec logo centré et encoche vers le bas */
        .idcard-header {
            background-color: #CFEEDC;
            position: relative;
            height: {{ ($preview ?? false) ? '130px' : '170px' }};
        }

        /* Le conteneur circulaire du logo */
        .idcard-header .logo {
            width: {{ ($preview ?? false) ? '80px' : '96px' }};
            height: {{ ($preview ?? false) ? '80px' : '96px' }};
            border-radius: 50%;
            background: #ffffff;
            overflow: hidden;
            border: 1px solid #A7D7B3;
            /* Centre absolu fiable pour dompdf */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* L'image du logo elle-même */
        .idcard-header .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain; /* garde les proportions et centre */
            object-position: center center;
            display: block;
            padding: 0;
        }

        /* Corps: photo centrée et titre large */
        .idcard-body {
            background: #ffffff;
            padding: 2rem 1.5rem 1.25rem;
            text-align: center;
        }

        .idcard-body .photo {
            width: {{ ($preview ?? false) ? '120px' : '180px' }};
            height: {{ ($preview ?? false) ? '120px' : '180px' }};
            border-radius: 24px;
            overflow: hidden;
            border: 2px solid #BFE6CF;
            margin: 0 auto 1rem;
            background: #ffffff;
        }

        .idcard-body h2 {
            font-size: {{ ($preview ?? false) ? '1.5rem' : '2.1rem' }};
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #4B4B4B;
            margin: 0.6rem 0 0;
        }

        /* Pied vert foncé avec encoche vers le haut et libellés en blanc */
        .idcard-footer {
            background-color: #1D503A;
            color: #ffffff;
            padding: {{ ($preview ?? false) ? '1rem 1rem' : '1.5rem 1.5rem' }};
            position: relative;
            font-size: {{ ($preview ?? false) ? '0.85rem' : '0.95rem' }};
        }

        .idcard-footer::before {
            content: '';
            position: absolute;
            left: 50%;
            top: -12px;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 12px solid transparent;
            border-right: 12px solid transparent;
            border-bottom: 12px solid #1D503A;
        }

        .idcard-footer div {
            margin-bottom: 0.35rem;
        }

        .idcard-footer span {
            opacity: 0.9;
            font-weight: 600;
        }

        .idcard-footer strong {
            font-weight: 800;
        }
    </style>
</head>

<body>
    @php
        $isPreview = $preview ?? false;
        // Préparer sources selon mode : URL web pour aperçu, chemin absolu pour PDF
        $logoPath = public_path('storage/logo-card.png');
        $logoUrl = asset('storage/logo-card.png');

        $photoDbPath = $member->photo_path ? ltrim($member->photo_path, '/') : null;
        $absolutePhotoPath = $photoDbPath ? public_path('storage/'.$photoDbPath) : null;
        $photoUrl = $photoDbPath ? asset('storage/'.$photoDbPath) : null;

        $headline = !empty($member->position_title) ? strtoupper($member->position_title) : strtoupper($member->last_name);
    @endphp

    <div class="idcard">
        <div class="idcard-header">
            <div class="logo">
                @if ($isPreview)
                    <img src="{{ $logoUrl }}" alt="Logo" style="max-width: 92px; max-height: 92px; object-fit: contain;">
                @else
                    @if (file_exists($logoPath))
                        <img src="{{ $logoPath }}" alt="Logo" style="max-width: 92px; max-height: 92px; object-fit: contain;">
                    @endif
                @endif
            </div>
            <div class="idcard-notch"></div>
        </div>

        <div class="idcard-body">
            <div class="photo">
                @if ($isPreview)
                    @if ($photoUrl)
                        <img src="{{ $photoUrl }}" alt="photo" style="width:100%; height:100%; object-fit: cover;">
                    @else
                        <div style="width:100%; height:100%; display:grid; place-items:center; color:#9CA3AF; font-size:12px;">Photo</div>
                    @endif
                @else
                    @if ($absolutePhotoPath && file_exists($absolutePhotoPath))
                        <img src="{{ $absolutePhotoPath }}" alt="photo" style="width:100%; height:100%; object-fit: cover;">
                    @else
                        <div style="width:100%; height:100%; display:grid; place-items:center; color:#9CA3AF; font-size:12px;">Photo</div>
                    @endif
                @endif
            </div>
            <h2>{{ $headline }}</h2>
        </div>

        <div class="idcard-footer">
            <div><span>Nom :</span> <strong>{{ strtoupper($member->last_name) }}</strong></div>
            <div><span>Prénoms :</span> <strong>{{ strtoupper($member->first_names) }}</strong></div>
            <div><span>Numéro d’adhérent :</span> <strong>{{ $member->member_number }}</strong></div>
            <div><span>Année d’adhésion :</span> <strong>{{ $member->join_year }}</strong></div>
        </div>
    </div>
</body>

</html>