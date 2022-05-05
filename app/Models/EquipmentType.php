<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentType extends Model
{
    use HasFactory;

    public function scopeSearch($query, $data)
    {
        if(isset($data['id'])) $query->where('id', '=', $data['id']);
        if(isset($data['name'])) $query->where('name', 'like', '%'.$data['name'].'%');
        if(isset($data['mask'])) $query->where('mask', '=', $data['mask']);

        return $query;
    }

    public function equipments()
    {
        return $this->hasMany(Equipment::class);
    }
}
