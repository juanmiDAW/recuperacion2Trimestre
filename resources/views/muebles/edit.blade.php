<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar mueble
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('muebles.update', $mueble) }}" class="max-w-sm mx-auto">
                @method('PUT')
                @csrf

                <div class="mb-5">
                    <x-input-label for="denominacion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Denominacion
                    </x-input-label>
                    <x-text-input name="denominacion" type="text" id="denominacion"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        :value="old('denominacion', $mueble->denominacion)" />
                    <x-input-error :messages="$errors->get('denominacion')" class="mt-2" />
                </div>
                @if ($mueble->fabricable_type === 'App\Models\Fabricado')
                    <div class="mb-5">
                        <x-input-label for="ancho"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Ancho
                        </x-input-label>
                        <x-text-input name="ancho" type="text" id="ancho"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            :value="old('ancho', $mueble->fabricable->ancho)" />
                        <x-input-error :messages="$errors->get('ancho')" class="mt-2" />
                    </div>
                    <div class="mb-5">
                        <x-input-label for="alto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Alto
                        </x-input-label>
                        <x-text-input name="alto" type="text" id="alto" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            :value="old('alto', $mueble->fabricable->alto)" />
                        <x-input-error :messages="$errors->get('alto')" class="mt-2" />
                    </div>
                    @elseif ($mueble->fabricable_type  === 'App\Models\Prefabricado')
                    <div class="mb-5">
                        <x-input-label for="precio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Precio
                        </x-input-label>
                        <x-text-input name="precio" type="text" id="precio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            :value="old('precio', $mueble->precio)" />
                        <x-input-error :messages="$errors->get('precio')" class="mt-2" />
                    </div>
                @endif
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Editar
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
