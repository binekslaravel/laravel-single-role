<?php

declare(strict_types = 1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

/**
 * Class AlterUsersTableAddColumnRoleId
 */
class AlterUsersTableAddColumnRoleId extends Migration
{
    /**
     * @var string
     */
    protected $table;

    /**
     * AlterUsersTableAddColumnRoleId constructor.
     */
    public function __construct()
    {
        $this->table = Config::get('single-role.tables.users');
    }

    /**
     * @return void
     */
    public function up(): void
    {
        Schema::table($this->table, function (Blueprint $table) {
            $table->unsignedInteger('role_id')->nullable();

            $table->foreign('role_id')
                ->references('id')
                ->on(Config::get('single-role.tables.roles'))
                ->onDelete('set null');
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::table($this->table, function (Blueprint $table) {
            $table->dropForeign(
                Config::get('single-role.tables.users').'_role_id_foreign'
            );

            $table->dropColumn('role_id');
        });
    }
}
