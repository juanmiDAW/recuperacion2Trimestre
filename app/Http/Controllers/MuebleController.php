<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMuebleRequest;
use App\Http\Requests\UpdateMuebleRequest;
use App\Models\Fabricado;
use App\Models\Mueble;
use App\Models\Prefabricado;
use Illuminate\Support\Facades\Validator;

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
    public function store(StoreMuebleRequest $request)
    {
        if ($request->tipo === 'App\Models\Fabricado') {
            $ancho = $request->ancho;
            $alto = $request->alto;

            $precio = ($ancho * $alto) * 1.20;

            $validate = $request->validate([
                'ancho' => 'required|decimal',
                'alto' => 'required|decimal',
            ]);

            $fabricado = Fabricado::crate($validate);
            
            $this->crearMueble($fabricado->id, $request->tipo, $precio,$request);
        } else if ($request->tipo === 'App\Models\Prefabricado') {
            $precio = $request->precio;

            $prefabricado = Prefabricado::create();
            $this->crearMueble($prefabricado->id, $request->tipo, $precio,$request);

        }
        
        return redirect()->route('muebles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mueble $mueble)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mueble $mueble)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMuebleRequest $request, Mueble $mueble)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mueble $mueble)
    {
        //
    }

    public function crearMueble($id, $tipo, $precio,$request)
    {
        // Validar los datos antes de crear el mueble
        $validate = Validator::make([
            'denominacion' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'fabricable_type' => 'required|string|in:App\Models\Fabricado,App\Models\Prefabricado',
            'fabricable_id' => 'required|integer',
        ]);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 400);
        }

        // Crear el Mueble asociado
        return Mueble::create([
            'denominacion' => $request->denominacion, 
            'precio' => $precio,
            'fabricable_type' => $tipo,
            'fabricable_id' => $id,
        ]);
    }
}
