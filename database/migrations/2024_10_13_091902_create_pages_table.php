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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();

            $table->string('slug');

            $table->string('title_ua');
            $table->string('title_en')->nullable();
            $table->mediumText('description_ua')->nullable();
            $table->mediumText('description_en')->nullable();

            $table->boolean('show')->default(false);
            $table->boolean('show_in_menu')->default(false);

            $table->string('seo_title_ua')->nullable();
            $table->string('seo_title_en')->nullable();
            $table->string('seo_keywords_ua')->nullable();
            $table->string('seo_keywords_en')->nullable();
            $table->text('seo_description_ua')->nullable();
            $table->text('seo_description_en')->nullable();

            $table->boolean('noindex')->default(false);
            $table->boolean('nofollow')->default(false);

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
