<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $password_history_enabled               = config('password-history.password_history.enable');

        $table                                  = config('password-history.password_history.table.name');
        $password_histories_table_pk            = config('password-history.password_history.table.primary_key');
        $password_histories_table_user_fk       = config('password-history.password_history.table.user_foreign_key');

        $users_table                            = config('password-history.user.table.name');
        $users_table_primary_key                = config('password-history.user.table.primary_key');

        $uuid_enable                            = config('password-history.uuids.enable');
        $uuid_column                            = config('password-history.uuids.column');

        if ($password_history_enabled && !Schema::hasTable($table)) {
            Schema::create('password_histories', function (Blueprint $table)
            use (
                $password_histories_table_pk, $uuid_enable, $uuid_column,
                $password_histories_table_user_fk, $users_table_primary_key, $users_table
            ) {
                
                $table->id($password_histories_table_pk) ->unsigned();

                if ($uuid_enable && $uuid_column !== null) {
                    $table->uuid($uuid_column);
                }

                $table->string('password');

                $table->unsignedBigInteger($password_histories_table_user_fk)->unsigned()->index();
                $table->foreign($password_histories_table_user_fk)->references($users_table_primary_key)->on($users_table)->onDelete('cascade');

                $table->timestamps();

            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table = config('password-history.password_history.table.name');

        Schema::dropIfExists($table);
    }
}
