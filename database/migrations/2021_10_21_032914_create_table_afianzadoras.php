<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAfianzadoras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afianzadoras', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('fianza');
            $table->date('fecha');
            $table->string('num_fianza');
            $table->double('monto',16,2);
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
        Schema::dropIfExists('table_afianzadoras');
    }
}
