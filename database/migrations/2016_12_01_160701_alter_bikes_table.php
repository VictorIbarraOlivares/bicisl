<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bikes', function (Blueprint $table) {
            $table->string('nota',30)->after('detalle');
            $table->string('descripcion',30)->after('nota');
            $table->integer('activa')->after('descripcion');
            $table->date('fecha_a')->after('activa')->comment('fecha en que llega la bicicleta');
            $table->time('hora_a')->after('fecha_a')->comment('hora en que llega la bicicleta');
            $table->date('fecha_s')->after('hora_a')->comment('fecha en que sale la bicicleta');
            $table->time('hora_s')->after('fecha_s')->comment('hora en que sale la bicicleta');
            $table->integer('encargado_a')->after('hora_s')->comment('id encargado llegada');
            $table->integer('encargado_s')->after('encargado_a')->comment('id encargado salida');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bikes', function (Blueprint $table) {
            $table->dropColumn('nota');
            $table->dropColumn('descripcion');
            $table->dropColumn('activa');
            $table->dropColumn('fecha_a');
            $table->dropColumn('hora_a');
            $table->dropColumn('fecha_s');
            $table->dropColumn('hora_s');
            $table->dropColumn('encargado_a');
            $table->dropColumn('encargado_s');
        });
    }
}
