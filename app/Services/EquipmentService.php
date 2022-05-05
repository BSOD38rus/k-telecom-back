<?php

namespace App\Services;


use App\Models\Equipment;

class EquipmentService
{
    /**
     * @param $request
     * @param int $paginate 0 - пагинация выключена, > 0 - параметр perpage
     * @return mixed
     */
    public function getRecords($request, int $paginate = 0)
    {
        $queries = $request->only(['id', 'equipment_type_id', 'serial', 'note']);
        $equipments = Equipment::search($queries);

        if ($paginate == 0) $equipments = $equipments->get();
        else $equipments = $equipments->paginate($paginate);

        return $equipments;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getRecord($id)
    {
        $equipment = Equipment::findOrFail($id);
        return $equipment;
    }


    /**
     * @param $request
     * @return \Illuminate\Support\Collection
     */

    public function saveRecord($request)
    {
        $result = collect();
        if ($request->has(['serial', 'equipment_type_id'])) {
            foreach ($request->serial as $serial) {
                $equipment = new Equipment;
                $equipment->equipment_type_id = $request->equipment_type_id;
                $equipment->serial = $serial;
                $equipment->note = $request->note;
                $equipment->save();
                $result->push($equipment);
            }
        } else {
            foreach ($request->all() as $record) {
                foreach ($record['serial'] as $serial) {
                    $equipment = new Equipment;
                    $equipment->equipment_type_id = $record['equipment_type_id'];
                    $equipment->serial = $serial;
                    $equipment->note = $record['note'];
                    $equipment->save();
                    $result->push($equipment);
                }
            }
        }
        return $result;
    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function updateRecord($request, $id)
    {
        $equipment = Equipment::findOrFail($id);
        $equipment->fill($request->only(['equipment_type_id', 'serial', 'note']));
        $equipment->save();
        return $equipment;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $equipment = Equipment::findOrFail($id);
        $equipment->delete();
        return $equipment;
    }
}
