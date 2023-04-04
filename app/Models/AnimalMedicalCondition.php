<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AnimalMedicalCondition extends Model
{
    use HasFactory;
    use softDeletes;
    protected $primaryKey = 'id';
    protected $table = 'animal_medical_conditions';
    protected $fillable = ['condition_name', 'condition_type','created_at','updated_at','deleted_at'];


    public function animal(){
        return $this->belongsTo('App\Models\Animal','id');
    }

    public function animalhealth(){
        return $this->hasMany('App\Models\AnimalHealth','condition_id');
    }
}
