<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateOrderStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->timestamps();
        });

        DB::table('order_statuses')->insert(
                array(
                       [ 'name' => 'Создан'],
                       [ 'name' => 'Подтвержден'],
                       [ 'name' => 'Готовиться к отправке'],
                       [ 'name' => 'Доставляться'],
                       [ 'name' => 'Выдан'],
                       [ 'name' => 'Отменен'],
                ));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_statuses');
    }
}
