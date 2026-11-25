<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable()->index();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('agency')->nullable();
            $table->string('license_no')->nullable();
            $table->string('avatar')->nullable();
            $table->text('description')->nullable();
            $table->decimal('rating', 3, 1)->default(5.0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });

        // Add houses -> agents foreign key after agents table exists
        if (Schema::hasTable('houses')) {
            Schema::table('houses', function (Blueprint $table) {
                $table->foreign('agent_id')->references('id')->on('agents')->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents');
    }
}
