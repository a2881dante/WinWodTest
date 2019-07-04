<?php

use App\Item;
use App\Size;
use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = Size::all();
        for($i=1; $i<11; $i++){
            $item = new Item([
                'name' => "Item ${i}",
                'avatar_url' => ''
            ]);
            $item->save();
            foreach ($sizes as $size){
                $item->sizes()->attach($size->id);
            }
        }
    }
}
