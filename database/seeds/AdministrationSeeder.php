<?php

use Illuminate\Database\Seeder;

class AdministrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\User;
        $administrator->username = "AdminGanteng";
        $administrator->name = "Admin Larashop";
        $administrator->address = "Bandung, Jawa barat";
        $administrator->phone = "0888222333";
        $administrator->avatar = "N/A";
        $administrator->email = "administrator@larashop.test";
        $administrator->roles = json_encode(["ADMIN"]);
        $administrator->password = \Hash::make("larashop");

        $administrator->save();

        $this->command->info("User admin berhasil dibuat!");
    }
}
