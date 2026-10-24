<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Onvit-e</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-slate-900">
    <header>
        {{-- [1/3] margin = espaço de fora de um item. gap = espaço entre os itens, definido pelo pai. --}}
        <div class="flex items-center gap-4">

            <div class="bg-red-200 p-4">
                <a href="/">
                    <img src="{{ asset('img/nanaborok-icon.png') }}" alt="Nana Borok Confecções" class="h-15">
                </a>
            </div>

            <div class="flex-1 bg-blue-200 p-4">
                <form action="" method="get" role="search"
                    class="flex items-center gap-3 rounded-full border border-gray-400 px-4 py-2 focus-within:ring-2 focus-within:ring-indigo-500">
                    <button type="submit" aria-label="Pesquisar" class="cursor-pointer">
                        <x-heroicon-s-magnifying-glass class="w-5 h-5 text-gray-500 hover:text-gray-700" />
                    </button>
                    <input id="search-input" type="text" name="q" placeholder="O que você procura?"
                        aria-label="Pesquisar produtos"
                        class="flex-1 focus:outline-none placeholder:text-gray-500 placeholder:font-medium">
                </form>
            </div>

            <div class="bg-green-200 p-4">
                <div class="flex items-center gap-4">
                    <button type="button" aria-label="Notificações" class="cursor-pointer">
                        <x-heroicon-s-bell class="w-7 h-7 text-gray-500 hover:text-gray-700" />
                    </button>

                    <button type="button" aria-label="Carrinho" class="cursor-pointer">
                        <x-heroicon-s-shopping-cart class="w-7 h-7 text-gray-500 hover:text-gray-700" />
                    </button>

                    <button type="button" aria-label="Perfil" class="ml-4 cursor-pointer">
                        <img src="{{ asset('img/icone-perfil.jpg') }}" alt="" class="h-10 rounded-full">
                    </button>
                </div>
            </div>
        </div>

        {{-- [2/3] --}}
        <nav aria-label="Menu principal" class="bg-purple-200 p-4">
            <ul class="flex items-center justify-center gap-20 border-b border-gray-300 bg-purple-300 py-3">
                <li>
                    <a href="#" class="text-2xl hover:text-indigo-600">Home</a>
                </li>

                <li>
                    <a href="{{ route('projetos') }}" 
                    @class(['text-2xl hover:text-indigo-600', 'bg-indigo-600' => $selecionado])>
                        Projetos
                    </a>
                </li>

                <li>
                    <a href="#" class="text-2xl hover:text-indigo-600">Personalize sua roupa</a>
                </li>

                <li>
                    <a href="#" class="text-2xl hover:text-indigo-600">Sobre nós</a>
                </li>

            </ul>
        </nav>

        {{-- [3/3] --}}
        <nav aria-label="Categorias" class="flex items-center justify-center gap-30 bg-orange-200 py-4 text-gray-800">
            <a href="#">Camisetas</a>
            <a href="#">Jaquetas</a>
            <a href="#">Moletons</a>
            <a href="#">Calças</a>
            <a href="#">Bermudas</a>
            <a href="#">Acessórios</a>
            <a href="#">Novidades</a>
            <a href="#">Promoções</a>
        </nav>
    </header>

    <main>
        @yield('conteudo')
    </main>
</body>
</html>