<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLockedByToFinanceTable extends Migration
{
    public function up()
    {
        Schema::table('finance', function (Blueprint $table) {
            $table->unsignedBigInteger('locked_by')->nullable()->after('purpose');
            $table->timestamp('locked_at')->nullable()->after('locked_by');
        });
    }

    public function down()
    {
        Schema::table('finance', function (Blueprint $table) {
            $table->dropColumn(['locked_by', 'locked_at']);
        });
    }
}
