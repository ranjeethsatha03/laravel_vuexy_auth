<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class DropSpatiePermissionTables extends Migration
{
    public function up()
    {
        Schema::dropIfExists('role_has_permissions');
        Schema::dropIfExists('model_has_roles');
        Schema::dropIfExists('model_has_permissions');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
    }

    public function down()
    {
        // Optional: Add code here to recreate the tables if needed
    }
}
