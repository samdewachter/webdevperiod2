<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$tags = [
    		[
    			"name" => "splashnfun",
    			"displayName" => "Splash 'n Fun"
    		],
    		[
    			"name" => "luxury",
    			"displayName" => "Luxury"
    		],
    		[
    			"name" => "new",
    			"displayName" => "New"
    		],
    		[
    			"name" => "onsale",
    			"displayName" => "On Sale"
    		],
    		[
    			"name" => "other",
    			"displayName" => "Other"
    		],
    	];

        DB::table('tags')->insert($tags);

    }
}
