<div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Denominacion</th>
                <th scope="col" class="px-6 py-3">Precio</th>
                <th scope="col" class="px-6 py-3">Dimensiones</th>
                <th scope="col" class="px-6 py-3">Acciones</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($muebles as $mueble)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <td class="px-6 py-4"><a href="{{ route('muebles.show', $mueble) }}"
                            class=" text-blue-800">{{ $mueble->denominacion }}</a></td>
                    <td class="px-6 py-4">{{ $mueble->precio }}</td>

                    @if ($mueble->fabricable_type === 'App\Models\Fabricado')
                        <td class="px-6 py-4">{{ $mueble->fabricable->ancho }}m X {{ $mueble->fabricable->alto }}m</td>
                    @else
                        <td class="px-6 py-4">Sin medidas</td>
                    @endif
                    <td class="px-6 py-4">
                        <a href="{{ route('muebles.edit', $mueble) }}">
                            <button type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Editar</button>
                        </a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
