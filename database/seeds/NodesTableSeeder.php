<?php

use Illuminate\Database\Seeder;

class NodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 3; $i++) {
            App\Node::create(['type' => 1, 'ip' => "127.0.0.1:800$i", 'area_id' => ($i + $i)]);
        }
    }
}
