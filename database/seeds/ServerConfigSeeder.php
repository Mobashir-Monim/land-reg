<?php

use Illuminate\Database\Seeder;

class ServerConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', file_get_contents('http://checkip.dyndns.com/'), $m);
        $externalIp = $m[1];
        $node = (new App\Node)->getNode($externalIp);
        $flag = (request()->ip() == '127.0.0.1');

        if (!$flag) {
            $type = $node->type == 1 ? 'Council' : ($node->type == 2 ? 'Information' : 'Computational');
            $name = $node->type == 1 ? 'Council '.$node->area_id : ($node->type == 2 ? 'Information '.$node->area_id.' - '.$node->childNumber() : 'Computational '.$node->area_id.' - '.$node->parent->childNumber().' - '.$node->childNumber());
        } else {
            $node = (new App\Node)->getNode('127.0.0.1');
        }

        $items = [
            ['name' => 'ip', 'description' => 'Internet Protocol of server in IPv4', 'value' => $flag ? '127.0.0.1' : $externalIp],
            ['name' => 'area', 'description' => 'The zone of the node in the architecture', 'value' => $node->area_id],
            ['name' => 'type', 'description' => 'The type of the node in the hierarchy', 'value' => $flag ? 'Localhost' : $type],
            ['name' => 'name', 'description' => 'The name of the node in the architecture', 'value' => $flag ? 'Localhost' : $name],
            ['name' => 'status', 'description' => 'The status of the node', 'value' => 'Active'],
        ];

        foreach ($items as $item) {
            App\ServerConfig::create($item);
        }
    }
}
