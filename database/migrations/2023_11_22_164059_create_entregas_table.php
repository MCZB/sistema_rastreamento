<?php

// database/migrations/{timestamp}_create_entregas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntregasTable extends Migration
{
    public function up()
    {
        Schema::create('entregas', function (Blueprint $table) {
            $table->id();
            $table->string('_id')->unique();
            $table->string('_id_transportadora');
            $table->string('_volumes');
            $table->json('_remetente');
            $table->json('_destinatario');
            $table->json('_rastreamento');
            $table->string('_cnpj')->nullable();
            $table->string('_fantasia')->nullable(); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('entregas');
    }
}
