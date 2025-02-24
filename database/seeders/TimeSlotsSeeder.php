<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TimeSlotsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startTime = Carbon::createFromFormat('H:i:s', '00:00:00');
        $endTime = Carbon::createFromFormat('H:i:s', '23:30:00');


        while ($startTime <= $endTime) {
            DB::table('time_slots')->insert([
                'time' => $startTime->format('H:i:s'),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $startTime->addMinutes(30);
        }
        $this->command->info('Time slots have been seeded!');
    }
}
