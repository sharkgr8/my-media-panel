<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMediaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('media', function(Blueprint $table)
		{
                        $table->engine = 'InnoDB';
			$table->increments('id');
                        $table->string('filename')->unique(); 
                        $table->smallInteger('views')->default(0)->unsigned();
                        $table->boolean('active')->default(false);;
                        $table->integer('added_by');
                        $table->integer('updated_by');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('media');
	}

}
