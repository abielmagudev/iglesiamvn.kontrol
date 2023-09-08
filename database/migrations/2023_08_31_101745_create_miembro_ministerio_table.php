<?php

use App\Models\Miembro;
use App\Models\Ministerio;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiembroMinisterioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('miembro_ministerio', function (Blueprint $table) {
            $table->foreignId('miembro_id')->references('id')->on(Miembro::getTableName())->onDelete('cascade');
            $table->foreignId('ministerio_id')->references('id')->on(Ministerio::getTableName())->onDelete('cascade');
            $table->text('funciones')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('miembro_ministerio');
    }
}
