<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $id = $request->segment(3);

        $categories = Category::select('id', 'section_id', 'status_id', 'title', 'subtitle', 'google_tag', 'position', 'color', 'start_date', 'end_date', 'georeferencing_type_id', 'icon_status_id', 'icon_type_id', 'icon', 'content_type_id', 'video_description', 'video_type_id', 'video_id', 'src_description', 'audio_src', 'text_description', 'pdf_description', 'pdf', 'iframe_description', 'iframe_url', 'phone', 'url_external_page', 'app_type_id', 'url_app', 'uri_app', 'url_desktop_app', 'url_not_installed_app', 'whatsapp_type_id', 'whatsapp_url')
            ->where('section_id', $id)
            ->orderBy('position')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $categories
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->id;

        $category = Category::find($id);

        return response()->json([
            'success' => true,
            'data' => $category
        ], 200);
    }
}
