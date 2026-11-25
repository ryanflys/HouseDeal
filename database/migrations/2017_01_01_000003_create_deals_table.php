<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('house_id')->unsigned()->index();
            $table->integer('agent_id')->unsigned()->nullable()->index();
            $table->integer('seller_id')->unsigned()->nullable()->index();
            $table->integer('buyer_id')->unsigned()->nullable()->index();
            $table->decimal('deal_price', 12, 2)->default(0);
            $table->string('status', 20)->default('pending');
            $table->string('deal_type', 20)->default('sale');
            $table->timestamp('signed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('house_id')->references('id')->on('houses')->onDelete('cascade');
            $table->foreign('agent_id')->references('id')->on('agents')->onDelete('set null');
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('buyer_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deals');
    }
}
