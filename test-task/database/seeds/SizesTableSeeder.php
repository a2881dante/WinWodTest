<?php

use App\Size;
use Illuminate\Database\Seeder;

class SizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = ['S', 'M', 'L', 'XL'];
        foreach ($arr as $item)
        {
            $size = new Size();
            $size->sign = $item;
            $size->save();
        }
    }
}
