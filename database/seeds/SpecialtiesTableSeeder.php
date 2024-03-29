<?php

use Illuminate\Database\Seeder;
use App\Specialty;
use App\User;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialties = [
            'Dermatología', 'Ginecología y obstetricia o tocología.', 'Oftalmología','Traumatología'
        ];
        foreach ($specialties as $specialtyName){
            $specialty = Specialty::create([
                'name' => $specialtyName
            ]);
            $specialty->users()->saveMany(
                factory(User::class, 3)->states('doctor')->make()
            );
        }
        User::find(2)->specialties()->save($specialty);        
    }
}
