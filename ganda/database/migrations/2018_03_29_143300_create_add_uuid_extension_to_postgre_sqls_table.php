<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateAddUuidExtensionToPostgreSqlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('add_uuid_extension_to_postgre_sqls', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->timestamps();
        // });

        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('add_uuid_extension_to_postgre_sqls');
        DB::statement('DROP EXTENSION IF EXISTS "uuid-ossp";');
    }
}
