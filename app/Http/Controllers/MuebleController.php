<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMuebleRequest;
use App\Http\Requests\UpdateMuebleRequest;
use App\Models\Fabricado;
use App\Models\Mueble;
use App\Models\Prefabricado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Validate;
use Psy\CodeCleaner\ReturnTypePass;

use function PHPUnit\Framework\returnSelf;

class MuebleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('muebles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('muebles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->tipo === 'App\Models\Fabricado') {
            $ancho = $request->ancho;
            $alto = $request->alto;

            $precio = ($ancho * $alto) * 10.20;

            $validate = $request->validate([
                'ancho' => 'required|numeric',
                'alto' => 'required|numeric',
            ]);

            $fabricado = Fabricado::create($validate);
            $this->crearMueble($fabricado->id, $request->tipo, $precio, $request);
        } else if ($request->tipo === 'App\Models\Prefabricado') {
            $precio = $request->precio;

            $prefabricado = Prefabricado::create();
            $this->crearMueble($prefabricado->id, $request->tipo, $precio, $request);
        }

        return redirect()->route('muebles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mueble $mueble)

    {
        return view('muebles.show', ['mueble' => $mueble]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mueble $mueble)
    {
        // dd($mueble);
        return view('muebles.edit', ['mueble' => $mueble]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mueble $mueble)
    {
        if ($mueble->fabricable_type == 'App\Models\Fabricado') {
            $validate = $request->validate([
                'denominacion' => 'required|string|max:255',
            ]);

            $mueble->fill($validate);

            $validate = $request->validate([
                'ancho' => 'required|numeric',
                'alto' => 'required|numeric',
            ]);
           
            $mueble->fabricable->fill($validate);
            $mueble->fabricable->save();

        } else if ($mueble->fabricable_type == 'App\Models\Prefabricado') {
            $validate = $request->validate([
                'denominacion' => 'required|string|max:255',
                'precio' => 'required|numeric',
            ]);

            $mueble->fill($validate);
            $mueble->save();
        }

        return redirect()->route('muebles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mueble $mueble)
    {
        //
    }

    public function crearMueble($id, $tipo, $precio, $request)
    {
        // Validar los datos antes de crear el mueble
        $validate = $request->validate([
            'denominacion' => 'required|string|max:255',
            'tipo' => 'required|string|in:App\Models\Fabricado,App\Models\Prefabricado',
        ]);
        // dd($validate);
        // if($request['ancho']&&$request['alto']){
        //     $validate
        // }
        $validate['fabricable_id'] = $id;
        $validate['fabricable_type'] = $tipo;
        $validate['precio'] = $precio;

        if ($request->tipo === 'App\Models\Fabricado') {
            $validate['ancho'] = $request->ancho;
            $validate['alto'] = $request->alto;
        }

        // if ($validate->fails()) {
        //     return response()->json(['errors' => $validate->errors()], 400);
        // }

        // Crear el Mueble asociado
        return Mueble::create($validate);
    }
}
