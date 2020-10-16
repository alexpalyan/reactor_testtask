<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrlClicksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url_clicks', function (Blueprint $table) {
            $table->timestamp('registered_at');
            $table->foreignId('url_id');
            $table->ipAddress('visitor_ip');
            $table->json('visitor_info');

            $table->index(['url_id', 'registered_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('url_clicks');
    }
}
