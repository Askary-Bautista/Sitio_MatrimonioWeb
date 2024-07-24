<?php

// Matrimonio.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matrimonio extends Model
{
    use HasFactory;

    protected $table = 'matrimonios';
    protected $fillable = [
        'persona1_id',
        'persona2_id',
        'fecha_matrimonio',
        'clausula'
    ];

    public function persona1()
    {
        return $this->belongsTo(Persona::class, 'persona1_id');
    }

    public function persona2()
    {
        return $this->belongsTo(Persona::class, 'persona2_id');
    }
}
