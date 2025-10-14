<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="page-bg">
<div id="dashboard-root" class="app-container">
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
                <div class="mt-3 flex items-center gap-2">
                    <button class="btn-ghost" onclick="openMemberModal({{ $member->id }})">Voir</button>
                    <button class="btn-primary-solid" onclick="printMemberCard({{ $member->id }})">Imprimer</button>
                </div>
                <template id="card-template-{{ $member->id }}">
                    @include('members._idcard', ['member' => $member])
                </template>
            </div>
        @empty
            <p class="muted">Aucun membre pour le moment.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $members->links() }}
    </div>

    <!-- Modal -->
    <div id="member-modal" class="fixed inset-0 hidden items-center justify-center z-50">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" onclick="closeMemberModal()"></div>
        <div class="relative p-0 z-10">
            <div id="member-modal-content" class="grid place-items-center"></div>
            <div class="mt-5 flex items-center justify-center gap-3">
                <button class="btn-ghost" onclick="closeMemberModal()">Fermer</button>
                <button id="member-modal-print" class="btn-primary-solid">Imprimer</button>
            </div>
        </div>
    </div>

    <script>
        function openMemberModal(id) {
            const tpl = document.getElementById('card-template-' + id);
            if (!tpl) return;
            const container = document.getElementById('member-modal-content');
            container.innerHTML = tpl.innerHTML;
            const modal = document.getElementById('member-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            const root = document.getElementById('dashboard-root');
            if (root) root.classList.add('blurred');

            const printBtn = document.getElementById('member-modal-print');
            printBtn.onclick = function () {
                printHtml(container.innerHTML);
            };
        }

        function closeMemberModal() {
            const modal = document.getElementById('member-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.getElementById('member-modal-content').innerHTML = '';

            const root = document.getElementById('dashboard-root');
            if (root) root.classList.remove('blurred');
        }

        function printMemberCard(id) {
            const tpl = document.getElementById('card-template-' + id);
            if (!tpl) return;
            printHtml(tpl.innerHTML);
        }

        function printHtml(html) {
            const printWindow = window.open('', '_blank');
            if (!printWindow) return;
            const doc = printWindow.document;
            doc.open();
            doc.write(`<!DOCTYPE html>
                <html>
                <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <title>Impression carte</title>
                    <style>
                        @page { size: A6; margin: 10mm; }
                        body { font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif; background: #fff; color: #064e3b; display: grid; place-items: center; }
                        .idcard { box-shadow: none !important; width: 340px; }
                        .idcard-header { background: #D7F0E1; height: 120px; }
                        .idcard-notch { width: 0; height: 0; border-left: 12px solid transparent; border-right: 12px solid transparent; border-top: 12px solid #D7F0E1; }
                    </style>
                    <link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}">
                </head>
                <body>
                    ${html}
                    <script>window.onload = function(){ window.print(); setTimeout(()=> window.close(), 300); }<\/script>
                </body>
                </html>`);
            doc.close();
        }
    </script>
</div>
</body>
</html>

