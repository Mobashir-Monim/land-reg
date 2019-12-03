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
        App\Node::create(['type' => 0, 'ip' => "127.0.0.1:8000", 'area_id' => 0]);
        
        for ($i = 1; $i <= 3; $i++) {
            App\Node::create(['type' => 1, 'ip' => "127.0.0.1:800$i", 'area_id' => $i]);
        }

        for ($i = 2; $i <= 3; $i++) {
            foreach (App\Node::where('type', ($i - 1))->get() as $parent) {
                for ($count = 1; $count <= 3; $count++) {
                    $node = App\Node::create(['type' => $i, 'ip' => "127.0.0.1:80", 'area_id' => $parent->area_id, 'parent_id' => $parent->id]);
                    $node->ip = $node->ip.($node->id > 10 ? '' : '0').($node->id - 1);
                    $node->save();
                }
            }
        }
    }
}
