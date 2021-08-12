<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPasswordChangedAtColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table = config('password-history.user.table.name');

        $password_changed_column_name = config('password-history.password_changed_tracker.column.name');
        $password_changed_column_type = config('password-history.password_changed_tracker.column.type');
           
        Schema::table($table, function (Blueprint $table)
        use($password_changed_column_name, $password_changed_column_type) {
            if (!password_changed_is_enabled_and_exists()) {
                $table->{$password_changed_column_type}($password_changed_column_name) ->nullable() ->after('password');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table = config('password-history.user.table.name');
        $password_changed_column_name = config('password-history.password_changed_tracker.column.name');

        Schema::table($table, function (Blueprint $table)
        use ($password_changed_column_name){
            if (password_changed_is_enabled_and_exists()) {
                $table->dropColumn($password_changed_column_name);
            }
        });
    }
}
