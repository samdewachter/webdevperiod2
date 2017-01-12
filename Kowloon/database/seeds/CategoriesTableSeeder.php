<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$categories = [
    		[
    			"name" => "Dog",
		    	"whitePhoto" => "white_dog.png",
		    	"colorPhoto" => "dog.png",
		    	"url" => "dog",
		    	"pluralName" => "Dogs"
    		],
    		[
    			"name" => "Cat",
		    	"whitePhoto" => "white_cat.png",
		    	"colorPhoto" => "cat.png",
		    	"url" => "cat",
		    	"pluralName" => "Cats"
    		],
    		[
    			"name" => "Bird",
		    	"whitePhoto" => "white_bird.png",
		    	"colorPhoto" => "bird.png",
		    	"url" => "bird",
		    	"pluralName" => "Birds"
    		],
    		[
    			"name" => "Fish",
		    	"whitePhoto" => "white_fish.png",
		    	"colorPhoto" => "fish.png",
		    	"url" => "fish",
		    	"pluralName" => "Fish"
    		],
    		[
	    		"name" => "Small animals",
		    	"whitePhoto" => "white_hamster.png",
		    	"colorPhoto" => "hamster.png",
		    	"url" => "smallanimals",
		    	"pluralName" => "Small animals"
    		],
    		[
    			"name" => "Other",
		    	"whitePhoto" => "other.png",
		    	"colorPhoto" => "other.png",
		    	"url" => "other",
		    	"pluralName" => "Other"
    		]
    	];


	    DB::table('categories')->insert($categories);

    }
}
