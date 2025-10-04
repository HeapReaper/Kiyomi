<?php

namespace Database\Seeders;

use Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Users\Models\User;
use Modules\Users\Models\Licence;
use Modules\Flights\Models\Flight;
use Modules\Flights\Models\SubmittedModel;
use Spatie\Permission\Models\Role;
use Faker\Factory as Faker;

class DemoData extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $roles = [
            'management',
            'junior_member',
            'aspirant_member',
            'member',
            'donor'
        ];

        $licences = [
            'RC motorplane',
            'RC helicopter',
            'RC glider',
            'RC multicopter',
            'Drone A1',
            'Drone A2',
            'Drone A3',
        ];

        $numberOfUsers = 120;
        $users = [];

        for ($i = 1; $i <= $numberOfUsers; $i++) {
            $user = User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'birthdate' => $faker->date('Y-m-d', '2005-01-01'),
                'address' => $faker->streetAddress(),
                'zip_code' => $faker->postcode(),
                'city' => $faker->city(),
                'mobile_phone' => $faker->phoneNumber(),
                'club_status' => $faker->numberBetween(0, 5),
                'knvvl' => $faker->numberBetween(1000, 9999),
                'rdw_number' => strtoupper($faker->bothify('??###??')),
                'instruct' => $faker->numberBetween(0, 1),
                'in_memoriam' => $faker->numberBetween(0, 1),
            ]);

            $user->assignRole(Role::findByName($faker->randomElement($roles)));

            $randomLicences = $faker->randomElements($licences, $faker->numberBetween(1, 3));
            $licenceIds = Licence::whereIn('name', $randomLicences)->pluck('id')->toArray();
            $user->licences()->sync($licenceIds);

            $users[] = $user;
        }

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@default.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
            'remember_token' => Str::random(10),
        ]);

        $admin->assignRole(Role::findByName('management'));
        $admin->licences()->sync(Licence::pluck('id')->toArray());
        $users[] = $admin;

        $numberOfFlights = 200;
        $modelTypes = [1, 2, 3, 4, 5];
        $powerTypes = [1, 2, 3, 4];

        for ($i = 1; $i <= $numberOfFlights; $i++) {
            $user = $faker->randomElement($users);

            $flight = Flight::create([
                'date' => $faker->dateTimeThisYear()->format('Y-m-d'),
                'start_time' => $faker->time('H:i'),
                'end_time' => $faker->time('H:i'),
            ]);

            $flight->user()->attach($user->id);

            $model = SubmittedModel::create([
                'model_type' => $faker->randomElement($modelTypes),
                'class' => $faker->randomElement($powerTypes),
            ]);

            $flight->submittedModel()->attach($model->id);
        }
    }
}
