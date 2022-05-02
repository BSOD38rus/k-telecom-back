<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 'equipments';
    protected $fillable = ['equipment_type_id', 'serial', 'note'];

    public function scopeSearch($query, $data)
    {
        if(isset($data['id'])) $query->where('id', '=', $data['id']);
        if(isset($data['equipment_type_id'])) $query->where('equipment_type_id', '=', $data['equipment_type_id']);
        if(isset($data['serial'])) $query->where('serial', 'like', '%'.$data['serial'].'%');
        if(isset($data['note'])) $query->where('note', 'like', '%'.$data['note'].'%');

        return $query;
    }
}
