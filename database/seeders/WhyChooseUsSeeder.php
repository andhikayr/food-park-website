<?php

namespace Database\Seeders;

use App\Models\SectionTitle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WhyChooseUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SectionTitle::insert([
            [
                'key' => 'why_choose_top_title',
                'value' => 'Lorem ipsum'
            ],[
                'key' => 'why_choose_main_title',
                'value' => 'Lorem ipsum dolor sit amet'
            ],[
                'key' => 'why_choose_sub_title',
                'value' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa doloremque eveniet quasi aut veniam animi est quis quae inventore iste eum optio recusandae nesciunt voluptates sed aliquid, quaerat natus vero!'
            ]
        ]);
    }
}
