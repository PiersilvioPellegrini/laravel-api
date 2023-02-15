<?php

namespace Database\Seeders;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = ["HTML","CSS", "JAVASCRIPT", "VUEJS", "PHP "];

        foreach($technologies as $technology){
            Technology::create([
                "name"=>$technology,
                "description"=> "descrizione tecnologia" . $technology      
            ]);
        }
    }
}
