<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Region;
use App\User;

class RegionToRegions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'info@luiscordero29.com')->first();
        $regions = DB::connection('mysql')->table('region')->get();
        foreach ($regions as $region) {
            $record = new Region;
            $record->user_id = $user->id;
            $record->id = $region->id_region;
            $record->description = $region->descripcion;
            $record->status = $region->reg_activo;
            $record->save();
        }
    }
}
