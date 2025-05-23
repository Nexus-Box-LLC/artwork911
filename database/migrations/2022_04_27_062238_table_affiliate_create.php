<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
       Schema::create('affiliate', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('company_name');
			$table->string('phone');
			$table->string('main_contact_name');
			$table->string('email');
			$table->string('link');
			$table->timestamps();
		});
    }
	
	public function down()
    {
       Schema::dropIfExists('affiliate');
    }
};
