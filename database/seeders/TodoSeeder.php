<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Todo;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Todo::create(['task' => 'Plan to do something awesome', 'done' => 0]);
        Todo::create(['task' => 'Nothing to To Do here', 'done' => 1]);
    }
}
