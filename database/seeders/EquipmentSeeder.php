<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Equipment::create([
            'equipment_type_id' => 1,
            'serial' => 'X0QWERT8ZZ',
            'note' => 'Запись 1, маска 1',
        ]);

        Equipment::create([
            'equipment_type_id' => 1,
            'serial' => 'X0QWERY8ZZ',
            'note' => 'Запись 2, маска 1',
        ]);

        Equipment::create([
            'equipment_type_id' => 1,
            'serial' => 'X0QWERY8ZR',
            'note' => 'Запись 3, маска 1',
        ]);

        ######

        Equipment::create([
            'equipment_type_id' => 2,
            'serial' => '0X9QW7-pi',
            'note' => 'Запись 4, маска 2',
        ]);

        Equipment::create([
            'equipment_type_id' => 2,
            'serial' => '0X9QW7_pq',
            'note' => 'Запись 5, маска 2',
        ]);

        Equipment::create([
            'equipment_type_id' => 2,
            'serial' => '0X9QW7@we',
            'note' => 'Запись 6, маска 2',
        ]);

        ######

        Equipment::create([
            'equipment_type_id' => 3,
            'serial' => '0X7RE8-SSF',
            'note' => 'Запись 7, маска 3',
        ]);

        Equipment::create([
            'equipment_type_id' => 3,
            'serial' => '0X7RE8_SEA',
            'note' => 'Запись 8, маска 3',
        ]);

        Equipment::create([
            'equipment_type_id' => 3,
            'serial' => '0X7RE8@GSA',
            'note' => 'Запись 9, маска 3',
        ]);
    }
}
