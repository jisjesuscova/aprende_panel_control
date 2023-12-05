<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;

class FrontContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $section_id = $request->segment(3);
        $category_id = $request->segment(4);

        $contents = Content::select('id', 'section_id', 'category_id', 'status_id', 'title', 'subtitle', 'google_tag', 'position', 'color', 'start_date', 'end_date', 'georeferencing_type_id', 'icon_status_id', 'icon_type_id', 'icon', 'content_type_id', 'video_description', 'video_type_id', 'video_id', 'src_description', 'audio_src', 'text_description', 'pdf_description', 'pdf', 'iframe_description', 'iframe_url', 'phone', 'url_external_page', 'app_type_id', 'url_app', 'uri_app', 'url_desktop_app', 'url_not_installed_app', 'whatsapp_type_id', 'whatsapp_url')
            ->where('section_id', $section_id)
            ->where('category_id', $category_id)
            ->orderBy('position')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $contents
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->id;
        
        $content = Content::find($id);

        return response()->json([
            'success' => true,
            'data' => $content
        ], 200);
    }
}
