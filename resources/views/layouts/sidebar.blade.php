<?
$url = url('/');
?>
<aside class="w-64 bg-white text-dark">
            <div class="p-4">
   
                <ul class="mt-4">
                    <li>
                        <a href="{{ route('dashboard') }}" class="block py-2 px-4 hover:bg-gray-700">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contas.index') }}" class="block py-2 px-4 hover:bg-gray-700">
                            Profile
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('acesso.index') }}" class="block py-2 px-4 hover:bg-gray-700">
                            Acesso
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('acesso.index') }}" class="block py-2 px-4 hover:bg-gray-700">
                            Acesso
                        </a>
                    </li>
                    
                    <!-- Adicione mais itens aqui -->
                </ul>
            </div>
        </aside>