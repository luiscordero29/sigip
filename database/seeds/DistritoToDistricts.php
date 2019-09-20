<?php

use Illuminate\Database\Seeder;
use App\District;
use App\Province;
use App\User;

class DistritoToDistricts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'info@luiscordero29.com')->first();
        $districts = DB::connection('mysql')->table('distrito')->get();
        foreach ($districts as $district) {
            $province = Province::where('id', $district->id_provincia)->first();
            $record = new District;
            $record->user_id = $user->id;
            $record->province_id = $province->province_id;
            $record->id = $district->id_provincia;
            $record->description = $district->descripcion;
            $record->observation = $district->observacion;
            $record->status = $district->reg_activo;
            $record->save();
        }
    }
}
