<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialAccountsTable extends Migration
{
    public function up(): void
    {
        Schema::create(
            'social_accounts',
            function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedBigInteger('provider_id')->index();
                $table->string('nickname')->nullable();
                $table->string('avatar')->nullable();
                $table->string('token')->nullable();
                $table->timestamp('token_expires_at')->nullable();
                $table->string('refresh_token')->nullable();
                $table->unsignedInteger('user_id');
                $table->timestamps();

                $table->foreign('user_id')->references('id')->on('users');
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('social_accounts');
    }
}
