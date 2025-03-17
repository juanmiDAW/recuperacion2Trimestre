<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fabricado extends Model
{
    /** @use HasFactory<\Database\Factories\FabricadoFactory> */
    use HasFactory;

    protected $fillable = [' ancho', 'alto'];

    public function muebles(){
        return $this->hasMany(Mueble::class);
    }
}
