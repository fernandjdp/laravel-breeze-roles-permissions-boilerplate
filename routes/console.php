<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('make:permission', function () {
    Artisan::call('db:seed --class=PermissionsSeeder');
    $this->info("Permissions created successfully");
})->purpose('Make permissions from the models in app/models');

Artisan::command('make:admin', function () {
    Artisan::call('db:seed --class=AdminSeeder');
    $this->info("Admin user created successfully");
})->purpose('Create an Admin user for testing/debug purposes');
