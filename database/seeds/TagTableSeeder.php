<?php

use Illuminate\Database\Seeder;
use OrlandoLibardi\PageCms\app\Page;
use OrlandoLibardi\OlCms\AdminCms\app\Admin;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
       $config = Admin::where("name", "Configurações")->first(); 

       Admin::create([
            'name' => 'Tags',
            'route' => 'tags.index',
            'icon' => 'fa fa-tags',
            'parent_id' => $config->id,
            'minimun_can' => 'edit',
            'order_at' => 5
        ]);     

    }
}
