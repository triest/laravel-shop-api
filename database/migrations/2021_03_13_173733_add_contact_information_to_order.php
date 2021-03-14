<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContactInformationToOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
                'orders',
                function (Blueprint $table) {
                    //
                    $table->string('value', 255)->nullable()->default(null);
                    $table->integer('information_type_id')->nullable()->default(null);
                }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
                'order',
                function (Blueprint $table) {
                    //
                    $table->dropColumn('value');
                    $table->dropColumn('information_type');
                }
        );
    }
}
