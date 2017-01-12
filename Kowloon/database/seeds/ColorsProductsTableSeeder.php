<?php

use Illuminate\Database\Seeder;

class ColorsProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$color_product = [
    		[
    			"product_id" => 1 ,
    			"color_id" => 4
    		],
    		[
    			"product_id" => 1 ,
    			"color_id" => 5
    		],

[
    			"product_id" => 1 ,
    			"color_id" => 6
    		],

[
    			"product_id" => 2 ,
    			"color_id" => 1
    		],

[
    			"product_id" => 2 ,
    			"color_id" => 2
    		],

[
    			"product_id" => 2 ,
    			"color_id" => 6
    		],

[
    			"product_id" => 3 ,
    			"color_id" => 3
    		],

[
    			"product_id" => 5 ,
    			"color_id" => 2
    		],

[
    			"product_id" => 5 ,
    			"color_id" => 4
    		],

[
    			"product_id" => 4 ,
    			"color_id" => 2
    		],

[
    			"product_id" => 4 ,
    			"color_id" => 3
    		],

[
    			"product_id" => 4 ,
    			"color_id" => 5
    		],

[
    			"product_id" => 6 ,
    			"color_id" => 1
    		],

[
    			"product_id" => 6 ,
    			"color_id" => 6
    		],

    	];

        DB::table('color_product')->insert($color_product);
    }
}
