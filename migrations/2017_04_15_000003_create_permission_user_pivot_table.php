<?php

declare(strict_types = 1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreatePermissionUserPivotTable
 */
class CreatePermissionUserPivotTable extends Migration
{
    /**
     * @var string
     */
    protected $table;

    /**
     * CreatePermissionUserPivotTable constructor.
     */
    public function __construct()
    {
        $this->table = Config::get('single-role.tables.permission_user');
    }

    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->unsignedInteger('permission_id')->index();
            $table->unsignedInteger('user_id')->index();

            $table->foreign('permission_id')
                ->references('id')
                ->on(Config::get('single-role.tables.permissions'))
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on(Config::get('single-role.tables.users'))
                ->onDelete('cascade');
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
