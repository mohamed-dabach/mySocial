<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("post_id");
            $table->foreign("post_id")->references("id")->on("posts")->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users")->cascadeOnUpdate()->cascadeOnDelete();
            $table->bigInteger("postLikeCount");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_likes', function (Blueprint $table) {
            $table->dropForeign("post_likes_post_id_foreign");
            $table->dropForeign("post_likes_user_id_foreign");
        });
        Schema::dropIfExists('post_likes');
    }
};
