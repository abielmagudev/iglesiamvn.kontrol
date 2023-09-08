<?php

use App\Models\Miembro;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiembrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('miembros', function (Blueprint $table) {
            $table->id();

            // Personal
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('nombres_apellidos')->index();
            $table->enum('clave_genero_biologico', Miembro::getClavesGenerosBiologicos())->index();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('lugar_nacimiento')->nullable();
            $table->enum('estado_civil', Miembro::getEstadosCiviles())->nullable()->index();
            
            // Domicilio
            $table->unsignedInteger('domicilio_miembro_id')->nullable();
            $table->string('direccion')->nullable()->index();
            $table->string('localidad')->nullable();

            // Contacto
            $table->string('numero_movil')->nullable()->index();
            $table->string('numero_telefono')->nullable()->index();
            $table->string('correo_electronico')->nullable()->index();
            $table->text('web')->nullable()->fulltext();

            // Adicional
            $table->text('emergencias')->nullable()->fulltext();
            $table->text('ocupaciones')->nullable()->fulltext();
            $table->text('notas')->nullable();

            // Membresia
            $table->date('fecha_registro')->nullable()->index();
            $table->boolean('activo')->default(1)->index();

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
        Schema::dropIfExists('miembros');
    }
}
