<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateATestResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ab_test_results', function (Blueprint $table) {
            $table->id();
            $table->integer('num_visitors_for_a');
            $table->integer('num_visitors_for_b');
            $table->integer('num_clicks_for_a');
            $table->integer('num_clicks_for_b');
        });

        DB::table('ab_test_results')->insert([
            'num_visitors_for_a'    => 0,
            'num_visitors_for_b'    => 0,
            'num_clicks_for_a'    => 0,
            'num_clicks_for_b'    => 0,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ab_test_results');
    }
}
