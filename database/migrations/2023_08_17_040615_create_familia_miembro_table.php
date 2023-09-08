<?php

use App\Models\Miembro;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamiliaMiembroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('familia_miembro', function (Blueprint $table) {
            $table->foreignId('familia_id')->constrained( Miembro::getTableName() )->onDelete('cascade');
            $table->foreignId('miembro_id')->constrained( Miembro::getTableName() )->onDelete('cascade');
            $table->string('familia_parentesco');
            $table->string('miembro_parentesco');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('familia_miembro');
    }
}
