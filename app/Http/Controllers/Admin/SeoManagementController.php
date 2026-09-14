<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeoManagementRequest;
use App\Models\SeoMeta;
use App\Services\ImageService;
use App\Services\SitemapService;
use Illuminate\Http\Request;

class SeoManagementController extends Controller
{
    public function seoManagement(){
        return view('admin.management.seo.index');
    }

    public function getSeoData(Request $request)
    {
        try {
            $data = SeoMeta::where('url', $request->url)->first();

            if ($data) {
                $data->og_image = ImageService::url($data->og_image, 'original', 'seo_og_image');
            }


            return success_response($data ?? [
                'route_name' => $request->route_name,
                'url' => $request->url,
                'meta_title' => '',
                'meta_description' => '',
                'og_title' => '',
                'og_image' => '',
                'schema_script' => '',
                'robots_txt' => "User-agent: *\nAllow: /",
                'sitemap_include' => true,
            ]);
        } catch (\Throwable $e) {
            report($e);

            return error_response('Failed to fetch SEO data.', 500);
        }
    }

    public function saveSeoData(SeoManagementRequest $request, SitemapService $sitemap){
        $data = $request->all();
        
        try {
            $seoMeta = SeoMeta::firstOrNew([
                'route_name' => $data['route_name'],
            ]);
            

            $seoMeta->fill(
                [
                    'url' => $data['url'] ?? null,
                    'meta_title' => $data['meta_title'] ?? null,
                    'meta_description' => $data['meta_description'] ?? null,
                    'og_title' => $data['og_title'] ?? null,
                    'schema_script' => $data['schema_script'] ?? null,
                    'robots_txt' => $data['robots_txt'] ?? null,
                    'sitemap_include' => $data['sitemap_include'],
                ]
            );

            if ($request->hasFile('og_image')) {
                $seoMeta->og_image = ImageService::uploadOrUpdate(
                    $request->file('og_image'),
                    $seoMeta->og_image ?? '',
                    'seo_og_image',
                    ['width' => 1200, 'height' => 630],
                    true
                );
            }


            $seoMeta->save();

            $sitemap->sync($data);

            return success_response($seoMeta, 'SEO settings saved successfully.');
        } catch (\Exception $e) {
            return error_response('Failed to create notification: ' . $e->getMessage(), 500);
        }
    }
}
