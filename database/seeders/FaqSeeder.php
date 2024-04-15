<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder {
    
    // Run the database seeds.
    // return void

    public function run() {
        factory(\App\Models\Faq::class, 30)->create();
    }
}
