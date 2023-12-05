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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->integer('section_id');
            $table->integer('category_id');
            $table->integer('status_id');
            $table->string('title');
            $table->string('subtitle');
            $table->string('google_tag');
            $table->integer('position');
            $table->text('color');
            $table->text('start_date');
            $table->text('end_date');
            $table->integer('georeferencing_type_id');
            $table->integer('region_id');
            $table->integer('commune_id');
            $table->integer('icon_statusid');
            $table->integer('icon_type_id');
            $table->text('icon');
            $table->integer('content_type_id');
            $table->text('video_description');
            $table->integer('video_type_id');
            $table->string('video_id');
            $table->text('src_description');
            $table->text('audio_src');
            $table->text('text_description');
            $table->text('pdf_description');
            $table->text('pdf');
            $table->text('iframe_description');
            $table->text('iframe_url');
            $table->string('phone');
            $table->text('url_external_page');
            $table->integer('app_type_id');
            $table->text('url_app');
            $table->text('uri_app');
            $table->text('url_desktop_app');
            $table->text('url_not_installed_app');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
