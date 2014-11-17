<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('LanguageTableSeeder');
	}

}

class LanguageTableSeeder extends Seeder {

    public function run()
    {
        DB::table('language')->delete();

        User::create(array('name' => 'English', 'code' => 'en'));
    }

}