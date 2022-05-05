<?php

namespace App\Services;

use App\Models\EquipmentType;

class EquipmentTypeService
{
    public function getRecords($request, int $paginate = 0){
        $queries = $request->only(['id', 'name', 'mask']);
        $equipments = EquipmentType::search($queries);

        if ($paginate == 0) $equipments = $equipments->get();
        else $equipments = $equipments->paginate($paginate);

        return $equipments;
    }
}
