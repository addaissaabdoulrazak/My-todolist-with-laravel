<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    use HasFactory;
    /*je pense que ceci est facultatif mais nous pouvons utiliser le mot clé protected pour que les données ne soit
    accessible qu'a l'interrieur de cette clase <<Verifier pour confirmé cette hypothèse*/
    protected $fillable =
    [
        'nom',
        'description',
        'done'
    ];
    protected $table = "todolist";
}
