<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $record = new User;
        $record->name = 'Luis Cordero';
        $record->email = 'info@luiscordero29.com';
        $record->password = Hash::make('gabriel02');
        $record->save();
        $record = new User;
        $record->name = 'admin';
        $record->email = 'admin@siti.com';
        $record->password = Hash::make('admin');
        $record->save();
    }
}
