<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Authentification</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="page-bg">
    <div class="min-h-screen flex items-center justify-center p-6">
        <div id="auth-root" class="w-full max-w-6xl grid grid-cols-1 md:grid-cols-2 gap-0 rounded-3xl overflow-hidden surface-card" data-initial-mode="{{ $mode ?? 'login' }}">
            <!-- Left visual / message -->
            <div class="relative p-8 md:p-12 bg-gradient-to-br from-emerald-900/60 to-lime-700/30">
                <div class="absolute inset-0 -z-10">
                    <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=1600&auto=format&fit=crop" alt="Visual" class="w-full h-full object-cover opacity-40">
                </div>
                <div class="max-w-sm text-white">
                    <p class="text-white/80 text-sm mb-2" style= "color: #BEF264 ">Atchokré Djere</p>
                    <h1 class="text-3xl md:text-4xl font-extrabold leading-tight">Explorez de nouveaux horizons,<br>un pas à la fois.</h1>
                    <p class="mt-4 text-white/80">Rejoignez la communauté et gérez vos adhésions facilement.</p>
                </div>
            </div>

            <!-- Right panel forms -->
            <div class="p-8 md:p-12 bg-white text-primary">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-semibold">@{{title}}</h2>
                    <div class="text-sm">
                        <span class="text-primary/70" id="switchLabel"></span>
                        <button id="switchBtn" class="ml-1 underline text-primary">@{{switchText}}</button>
                    </div>
                </div>

                <div class="flex items-center gap-3 mb-6">
                    <button class="btn-outline border-primary text-primary">Continuer avec Google</button>
                    <button class="btn-outline border-primary text-primary">Facebook</button>
                </div>

                <div class="text-center text-sm text-primary/70 mb-6">ou avec votre adresse e‑mail</div>

                <!-- Login form -->
                <form id="loginForm" method="post" action="{{ route('login') }}" class="space-y-4 transition duration-300">
                    @csrf
                    @if ($errors->any() && ($mode ?? 'login') === 'login')
                        <div class="bg-red-50 text-red-700 p-2 rounded">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div>
                        <label class="label">Email</label>
                        <input type="email" name="email" class="input-green" required>
                    </div>
                    <div>
                        <label class="label">Mot de passe</label>
                        <input type="password" name="password" class="input-green" required>
                    </div>
                    <div class="flex items-center gap-2 text-sm">
                        <input id="remember" type="checkbox" name="remember" class="checkbox-green">
                        <label for="remember" class="text-primary/80">Se souvenir de moi</label>
                    </div>
                    <button class="w-full btn-primary-solid">Se connecter</button>
                </form>

                <!-- Register form -->
                <form id="registerForm" method="post" action="{{ route('register') }}" class="space-y-4 transition duration-300 hidden">
                    @csrf
                    @if ($errors->any() && ($mode ?? 'login') === 'register')
                        <div class="bg-red-50 text-red-700 p-2 rounded">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div>
                        <label class="label">Nom complet</label>
                        <input type="text" name="name" class="input-green" required>
                    </div>
                    <div>
                        <label class="label">Email</label>
                        <input type="email" name="email" class="input-green" required>
                    </div>
                    <div>
                        <label class="label">Mot de passe</label>
                        <input type="password" name="password" class="input-green" required>
                    </div>
                    <div>
                        <label class="label">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation" class="input-green" required>
                    </div>
                    <div class="flex items-start gap-2 text-sm">
                        <input type="checkbox" class="checkbox-green mt-1" required>
                        <p class="text-primary/80">J’accepte les conditions et la politique de confidentialité</p>
                    </div>
                    <button class="w-full btn-primary-solid">Créer le compte</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        window.__authInitialMode = '{{ $mode ?? 'login' }}';
    </script>
</body>
</html>

