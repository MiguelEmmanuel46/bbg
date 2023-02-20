<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactoForm extends Model
{
    use HasFactory;
     protected $table = 'contacto_forms';
     protected $fillable = [
        'name', 'email', 'telefono', 'mensaje'
    ];

}
