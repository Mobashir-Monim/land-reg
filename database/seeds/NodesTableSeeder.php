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
            ['type' => 1, 'ip' => '52.77.239.88', 'area_id' => 1, 'parent_id' => null],
            ['type' => 1, 'ip' => '18.140.65.32', 'area_id' => 2, 'parent_id' => null],
            ['type' => 1, 'ip' => '18.139.3.129', 'area_id' => 3, 'parent_id' => null],

            // Area 1 Information Nodes
            ['type' => 2, 'ip' => '13.250.116.31', 'area_id' => 1, 'parent_id' => 1],
            ['type' => 2, 'ip' => '3.0.16.70', 'area_id' => 1, 'parent_id' => 1],
            ['type' => 2, 'ip' => '18.136.213.8', 'area_id' => 1, 'parent_id' => 1],

            // Area 2 Information Nodes
            ['type' => 2, 'ip' => '13.250.108.8', 'area_id' => 2, 'parent_id' => 2],
            ['type' => 2, 'ip' => '18.138.253.183', 'area_id' => 2, 'parent_id' => 2],
            ['type' => 2, 'ip' => '18.141.12.234', 'area_id' => 2, 'parent_id' => 2],

            // Area 3 Information Nodes
            ['type' => 2, 'ip' => '54.254.176.135', 'area_id' => 3, 'parent_id' => 3],
            ['type' => 2, 'ip' => '3.0.91.160', 'area_id' => 3, 'parent_id' => 3],
            ['type' => 2, 'ip' => '54.179.163.68', 'area_id' => 3, 'parent_id' => 3],

            // Computational Nodes 1 - 4
            ['type' => 2, 'ip' => '18.136.204.235', 'area_id' => 1, 'parent_id' => 4],
            ['type' => 2, 'ip' => '3.1.218.167', 'area_id' => 1, 'parent_id' => 4],
            ['type' => 2, 'ip' => '54.179.175.217', 'area_id' => 1, 'parent_id' => 4],

            // Computational Nodes 1 - 5
            ['type' => 2, 'ip' => '3.0.52.200', 'area_id' => 1, 'parent_id' => 5],
            ['type' => 2, 'ip' => '52.221.208.121', 'area_id' => 1, 'parent_id' => 5],
            ['type' => 2, 'ip' => '18.138.254.170', 'area_id' => 1, 'parent_id' => 5],

            // Computational Nodes 1 - 6
            ['type' => 2, 'ip' => '13.229.135.131', 'area_id' => 1, 'parent_id' => 6],
            ['type' => 2, 'ip' => '18.136.193.13', 'area_id' => 1, 'parent_id' => 6],
            ['type' => 2, 'ip' => '54.255.168.132', 'area_id' => 1, 'parent_id' => 6],

            // Computational Nodes 2 - 7
            ['type' => 2, 'ip' => '54.251.133.138', 'area_id' => 2, 'parent_id' => 7],
            ['type' => 2, 'ip' => '13.229.102.56', 'area_id' => 2, 'parent_id' => 7],
            ['type' => 2, 'ip' => '18.139.227.63', 'area_id' => 2, 'parent_id' => 7],

            // Computational Nodes 2 - 8
            ['type' => 2, 'ip' => '3.0.57.115', 'area_id' => 2, 'parent_id' => 8],
            ['type' => 2, 'ip' => '54.251.161.23', 'area_id' => 2, 'parent_id' => 8],
            ['type' => 2, 'ip' => '3.0.78.88', 'area_id' => 2, 'parent_id' => 8],
            
            // Computational Nodes 2 - 9
            ['type' => 2, 'ip' => '54.169.137.218', 'area_id' => 2, 'parent_id' => 9],
            ['type' => 2, 'ip' => '18.141.8.38', 'area_id' => 2, 'parent_id' => 9],
            ['type' => 2, 'ip' => '13.250.14.253', 'area_id' => 2, 'parent_id' => 9],
            
            // Computational Nodes 3 - 10
            ['type' => 2, 'ip' => '13.250.111.224', 'area_id' => 3, 'parent_id' => 10],
            ['type' => 2, 'ip' => '18.140.70.26', 'area_id' => 3, 'parent_id' => 10],
            ['type' => 2, 'ip' => '52.221.232.159', 'area_id' => 3, 'parent_id' => 10],

            // Computational Nodes 3 - 11
            ['type' => 2, 'ip' => '54.169.184.86', 'area_id' => 3, 'parent_id' => 11],
            ['type' => 2, 'ip' => '18.141.8.156', 'area_id' => 3, 'parent_id' => 11],
            ['type' => 2, 'ip' => '18.139.255.16', 'area_id' => 3, 'parent_id' => 11],
            
            // Computational Nodes 3 - 12
            ['type' => 2, 'ip' => '18.141.24.199', 'area_id' => 3, 'parent_id' => 12],
            ['type' => 2, 'ip' => '18.139.224.37', 'area_id' => 3, 'parent_id' => 12],
            ['type' => 2, 'ip' => '13.229.247.212', 'area_id' => 3, 'parent_id' => 12],
        ];
        
        foreach ($nodes as $node) {
            \App\Node::create($node);
        }
    }
}
