<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\RoleUser;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('active');
            $table->string('position')->default('member');
            $table->boolean('is_delete')->default(0);
            $table->timestamps();
        });

        $data_user['name']          = 'super admin';
        $data_user['email']         = 'edocsetiawan@gmail.com';
        $data_user['password']      = bcrypt('password');
        $user                       = User::create($data_user);

        $data_role['user_id']       = $user->id;
        $data_role['status']        = 'active';
        $data_role['position']      = 'super_admin';
        RoleUser::create($data_role);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_user');
    }
}
