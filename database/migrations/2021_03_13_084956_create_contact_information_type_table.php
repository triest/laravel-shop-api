<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateContactInformationTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
                'contact_information_type',
                function (Blueprint $table) {
                    $table->id();
                    $table->string('name');
                    $table->timestamps();
                }
        );

        DB::table('contact_information_type')->insert(
                array(
                        [
                                'id' => 1,
                                'name' => 'email'
                        ],
                        [
                                'id' => 2,
                                'name' => 'phone'
                        ],
                        [
                                'id' => 3,
                                'name' => 'viber'
                        ],
                )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_information_type');
    }
}
