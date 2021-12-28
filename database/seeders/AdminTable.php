<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$9kLFa7UCOWyjeUY08jYVb.tX2uxLRKaLK.w7bPaJuzKE5qhXCIbMq',
            'level' => 'admin'
        ]);
    }
}
