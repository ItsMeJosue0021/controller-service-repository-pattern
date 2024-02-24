<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('tasks')->insert([
                'name' => Str::random(10),
                'description' => Str::random(50),
                'status' => $this->getRandomStatus(),
                'start_date' => now()->subDays(rand(0, 30)),
                'end_date' => now()->addDays(rand(1, 30)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function getRandomStatus()
    {
        $statuses = ['pending', 'in progress', 'completed'];
        return $statuses[array_rand($statuses)];
    }
}
