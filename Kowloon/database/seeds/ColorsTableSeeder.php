<?php

use Illuminate\Database\Seeder;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$colors = [
    		[
    			"name" => "red",
    			"hexa" => "#FF0000"
    		],
    		[
    			"name" => "green",
    			"hexa" => "#008000"
    		],
    		[
    			"name" => "blue",
    			"hexa" => "#0000FF"
    		],
    		[
    			"name" => "orange",
    			"hexa" => "#FFA500"
    		],
    		[
    			"name" => "black",
    			"hexa" => "#000000"
    		],
    		[
    			"name" => "white",
    			"hexa" => "#FFFFFF"
    		],
    	];

        DB::table('colors')->insert($colors);
    }
}
