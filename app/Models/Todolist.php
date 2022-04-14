<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

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


    /**
     **get user create to this todo
     *
     * TODO: rappel:the particularity of the model is to containt method.
     * 
     * ? BelongsTo = appartient à
     * 
     * ! relation one to many, in this class we have a belongsTo relation 
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * get user affected to this todo 
     */
    public function TodAffectedTo()
    {
        return $this->belongsTo(User::class, 'affectedTo_id');
    }

    /**
     * get user who has affected to this todo
     */
    public function TodoAffectedBy()
    {
        return $this->belongsTo(User::class, 'affectedBy_id');
    }
}
