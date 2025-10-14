<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        .action-btn {
            transition: all 0.2s ease-in-out;
            cursor: pointer;
        }
        .action-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        /* Effets de survol spécifiques pour chaque couleur */
        .btn-voir:hover {
            background-color: #2563eb !important;
            color: white !important;
            border-color: #2563eb !important;
        }
        
        .btn-modifier:hover {
            background-color: #ea580c !important;
            color: white !important;
            border-color: #ea580c !important;
        }
        
        .btn-imprimer:hover {
            background-color: white !important;
            color: #16a34a !important;
            border-color: #16a34a !important;
        }
        
        .btn-supprimer:hover {
            background-color: white !important;
            color: #dc2626 !important;
            border-color: #dc2626 !important;
        }
    </style>
    @php use Illuminate\Support\Facades\Storage; @endphp
</head>

<body class="page-bg">
    <div id="dashboard-root" class="app-container">
        <header class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold">Dashboard des membres</h1>
            <nav class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="btn-ghost">Accueil</a>
                <a href="{{ route('members.create') }}" class="btn-primary-solid">Ajouter un membre</a>
            </nav>
        </header>

        @if (session('status'))
        <div class="bg-green-50 text-green-800 p-3 rounded mb-4">
            {{ session('status') }}
        </div>
        @endif

        <div class="w-full overflow-x-auto bg-white/5 rounded-lg ring-1 ring-white/10 border-l-4 border-r-4 border-white/20">
            <table class="w-full divide-y divide-gray-200 text-sm border-collapse">
                <thead class="bg-emerald-900 text-white">
                    <tr>
                        <th class="px-4 py-3 text-center font-medium border-l-2 border-r-2 border-white/30">#</th>
                        <th class="px-4 py-3 text-center font-medium border-l-2 border-r-2 border-white/30">Nom</th>
                        <th class="px-4 py-3 text-center font-medium border-l-2 border-r-2 border-white/30">Prénoms</th>
                        <th class="px-4 py-3 text-center font-medium border-l-2 border-r-2 border-white/30">N° Adhérent</th>
                        <th class="px-4 py-3 text-center font-medium border-l-2 border-r-2 border-white/30">Année d'adhésion</th>
                        <th class="px-4 py-3 text-center font-medium border-l-2 border-white/30">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white/10">
                    @forelse ($members as $member)
                    <tr>
                        <td class="px-4 py-3 text-center border-l-2 border-r-2 border-white/20 font-semibold text-emerald-600">{{ $loop->iteration + ($members->currentPage() - 1) * $members->perPage() }}</td>
                        <td class="px-4 py-3 text-center border-l-2 border-r-2 border-white/20">{{ $member->last_name }}</td>
                        <td class="px-4 py-3 text-center border-l-2 border-r-2 border-white/20">{{ $member->first_names }}</td>
                        <td class="px-4 py-3 text-center font-semibold border-l-2 border-r-2 border-white/20 text-emerald-700">{{ $member->member_number }}</td>
                        <td class="px-4 py-3 text-center border-l-2 border-r-2 border-white/20">{{ $member->join_year }}</td>
                        <td class="px-4 py-3 text-center border-l-2 border-white/20">
                            <div class="flex justify-center gap-2">
                                <button class="action-btn btn-voir p-2 text-blue-600 rounded-lg border border-blue-200" onclick="openMemberModal({{ $member->id }})" title="Voir">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                                <a href="{{ route('members.edit', $member->id) }}" class="action-btn btn-modifier p-2 text-orange-600 rounded-lg border border-orange-200" title="Modifier">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <button class="action-btn btn-imprimer p-2 text-white rounded-lg border border-white/30" onclick="printMemberCard({{ $member->id }})" title="Imprimer">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                    </svg>
                                </button>
                                <form action="{{ route('members.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Supprimer ce membre ?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn btn-supprimer p-2 text-white rounded-lg border border-white/30" title="Supprimer">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            <template id="card-template-{{ $member->id }}">
                                @include('members._idcard', ['member' => $member])
                            </template>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">
                            Aucun membre trouvé.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-center">
            <div class="bg-white/10 rounded-lg p-4">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm text-white-600">Page {{ $members->currentPage() }} sur {{ $members->lastPage() }}</span>
                    <span class="text-sm text-white-600">{{ $members->total() }} membre(s) au total</span>
                </div>
                {{ $members->links() }}
            </div>
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
                printBtn.onclick = function() {
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