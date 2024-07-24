<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Persona extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'personas';

    protected $fillable = [
        'name',
        'primer_apellido',
        'segundo_apellido',
        'email',
        'password',
        'fecha_nacimiento',
        'sexo',
        'estado_civil',
        'entidad_nacimiento',
        'municipio_nacimiento',
        'nacionalidad',
        'nombre_madre',
        'nombre_padre',
        'nacionalidad_madre',
        'nacionalidad_padre',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Si deseas modificar ciertos campos
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $guarded = ['id'];

    public function estaCasado()
    {
        // Verifica si la persona está involucrada en algún matrimonio
        return $this->matrimonios()->exists();
    }

    /**
     * Define la relación de la persona con los matrimonios.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function matrimonios()
    {
        // Define la relación uno a muchos con el modelo Matrimonio
        return $this->hasMany(Matrimonio::class, 'persona1_id')->orWhere('persona2_id', $this->id);
    }

    // Método para buscar personas por nombre, primer apellido, segundo apellido o email
    public static function buscar($query)
    {
        return static::where('name', 'LIKE', "%$query%")
            ->orWhere('primer_apellido', 'LIKE', "%$query%")
            ->orWhere('segundo_apellido', 'LIKE', "%$query%")
            ->orWhere('email', 'LIKE', "%$query%")
            ->get();
    }
}
