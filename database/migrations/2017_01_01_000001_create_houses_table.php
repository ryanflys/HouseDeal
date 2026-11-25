<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('agent_id')->unsigned()->nullable()->index();
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2)->default(0);
            $table->decimal('rent_price', 10, 2)->default(0);
            $table->string('type', 20)->default('second');
            $table->string('status', 20)->default('sale');
            $table->string('city', 50)->nullable();
            $table->string('district', 50)->nullable();
            $table->string('address')->nullable();
            $table->decimal('area', 8, 2)->default(0);
            $table->tinyInteger('bedrooms')->default(0);
            $table->tinyInteger('living_rooms')->default(0);
            $table->tinyInteger('bathrooms')->default(0);
            $table->string('floor')->nullable();
            $table->string('total_floor')->nullable();
            $table->string('orientation', 20)->nullable();
            $table->string('decoration', 20)->nullable();
            $table->text('images')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('houses');
    }
}
