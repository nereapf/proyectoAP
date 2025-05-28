<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Acceso Administrador</title>
    @vite (["resources/css/app.css", "resources/js/app.js"])
</head>
<body class="flex flex-col min-h-screen">
    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" />
    <div class="bg-azulFondo min-h-screen flex items-center justify-center pt-10">
        <div class="relative w-full max-w-sm">
            <div class="absolute -top-16 left-1/2 transform -translate-x-1/2">
                <div class="bg-white rounded-full">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-32 h-32 object-contain">
                </div>
            </div>
            <div class="bg-white rounded-xl pt-20 pb-8 px-8 shadow-md">
                <h2 class="text-2xl font-bold text-center mb-6">Acceso Administrador</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- User -->
                    <div class="mb-4">
                        <x-input-label for="email" class="block text-sm font-medium mb-1">Correo electrónico</x-input-label>
                        <x-text-input id="email" name="email" type="text" placeholder="Mail"
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                               required autofocus value="{{ old('email') }}"/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" class="block text-sm font-medium mb-1">Contraseña</x-input-label>
                        <x-text-input id="password" name="password" type="password" placeholder="Password"
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                               required/>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <button type="submit"
                            class="w-full bg-black text-white font-semibold py-2 mt-8 rounded transition hover:bg-azulBoton">
                        Confirmar
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
