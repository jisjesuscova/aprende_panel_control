<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'section_id',
        'category_id',
        'status_id',
        'title',
        'google_tag',
        'position',
        'color',
        'start_date',
        'end_date',
        'georeferencing_type_id',
        'icon_status_id',
        'icon_type_id',
        'icon',
        'content_type_id',
        'video_description',
        'video_type_id',
        'video_id',
        'src_description',
        'audio_src',
        'text_description',
        'pdf_description',
        'pdf',
        'iframe_description',
        'iframe_url',
        'phone',
        'url_external_page',
        'app_type_id',
        'url_app',
        'uri_app',
        'url_desktop_app',
        'url_not_installed_app',
        'whatsapp_type_id',
        'whatsapp_url',
    ];

    protected $dates = ['deleted_at'];
}
