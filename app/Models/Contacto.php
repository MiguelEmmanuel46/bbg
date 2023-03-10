<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;
    protected $table = 'users_contact';
    //relacion de muchos a uno
    
    /***********si sirve************************/
     public function servicios() {
        return $this->belongsTo('App\Models\Servicios', 'id');
    }
}
