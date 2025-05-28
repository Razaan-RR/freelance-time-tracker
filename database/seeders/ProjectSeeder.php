<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Project;
use Carbon\Carbon;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        $clients = Client::all();

        Project::create([
            'client_id' => $clients[0]->id,
            'title' => 'Website Redesign',
            'description' => 'Redesign homepage and dashboard.',
            'status' => 'active',
            'deadline' => Carbon::now()->addDays(10),
        ]);

        Project::create([
            'client_id' => $clients[1]->id,
            'title' => 'Mobile App Fixes',
            'description' => 'Fix login bug and improve UI.',
            'status' => 'completed',
            'deadline' => Carbon::now()->addDays(5),
        ]);
    }
}
