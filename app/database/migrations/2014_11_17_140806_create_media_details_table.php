<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMediaDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('media_details', function(Blueprint $table)
		{
                        $table->engine = 'MyISAM';
			$table->increments('id');
                        $table->integer('media_id')->unsigned();
                        $table->foreign('media_id')->references('id')->on('media')->onDelete('cascade');
                        $table->string('lang_code',5)->default('en');
                        $table->foreign('lang_code')->references('code')->on('language')->onDelete('cascade');
                        $table->string('title');
                        $table->text('tags');			
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
                $table = Schema::table('media_details');
                $table->dropForeign('media_details_media_id_foreign');
                $table->dropForeign('media_details_lang_code_foreign');
		Schema::drop('media_details');
	}

}
