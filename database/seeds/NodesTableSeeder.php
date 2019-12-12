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
        $nodes = [
            // Council Nodes
            ['type' => 1, 'ip' => '127.0.0.1:8000', 'area_id' => 1, 'parent_id' => null],
            ['type' => 1, 'ip' => '127.0.0.1:8000', 'area_id' => 2, 'parent_id' => null],
            ['type' => 1, 'ip' => '127.0.0.1:8000', 'area_id' => 3, 'parent_id' => null],

            // Area 1 Information Nodes
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 1, 'parent_id' => 1],
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 1, 'parent_id' => 1],
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 1, 'parent_id' => 1],

            // Area 2 Information Nodes
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 2, 'parent_id' => 2],
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 2, 'parent_id' => 2],
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 2, 'parent_id' => 2],

            // Area 3 Information Nodes
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 3, 'parent_id' => 3],
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 3, 'parent_id' => 3],
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 3, 'parent_id' => 3],

            // Computational Nodes 1 - 4
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 1, 'parent_id' => 4],
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 1, 'parent_id' => 4],
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 1, 'parent_id' => 4],

            // Computational Nodes 1 - 5
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 1, 'parent_id' => 5],
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 1, 'parent_id' => 5],
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 1, 'parent_id' => 5],

            // Computational Nodes 1 - 6
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 1, 'parent_id' => 6],
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 1, 'parent_id' => 6],
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 1, 'parent_id' => 6],

            // Computational Nodes 2 - 7
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 2, 'parent_id' => 7],
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 2, 'parent_id' => 7],
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 2, 'parent_id' => 7],

            // Computational Nodes 2 - 8
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 2, 'parent_id' => 8],
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 2, 'parent_id' => 8],
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 2, 'parent_id' => 8],
            
            // Computational Nodes 2 - 9
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 2, 'parent_id' => 9],
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 2, 'parent_id' => 9],
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 2, 'parent_id' => 9],
            
            // Computational Nodes 3 - 10
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 3, 'parent_id' => 10],
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 3, 'parent_id' => 10],
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 3, 'parent_id' => 10],

            // Computational Nodes 3 - 11
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 3, 'parent_id' => 11],
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 3, 'parent_id' => 11],
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 3, 'parent_id' => 11],
            
            // Computational Nodes 3 - 12
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 3, 'parent_id' => 12],
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 3, 'parent_id' => 12],
            ['type' => 2, 'ip' => '127.0.0.1:8000', 'area_id' => 3, 'parent_id' => 12],
        ];
        
        foreach ($nodes as $node) {
            \App\Node::create($node);
        }
    }
}
