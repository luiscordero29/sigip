<?php

use Illuminate\Database\Seeder;
use App\Province;
use App\Region;
use App\User;

class ProvinciaToProvinces extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'info@luiscordero29.com')->first();
        $provinces = DB::connection('mysql')->table('provincia')->get();
        foreach ($provinces as $province) {
            $region = Region::where('id', $province->id_region)->first();
            $record = new Province;
            $record->user_id = $user->id;
            $record->region_id = $region->region_id;
            $record->id = $province->id_provincia;
            $record->description = $province->descripcion;
            $record->observation = $province->observacion;
            $record->status = $province->reg_activo;
            $record->save();
        }
    }
}
