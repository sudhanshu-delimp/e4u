<?php

namespace App\Services;

use App\Models\Escort;

class SeoResolver
{

    protected static function fallback(){
        return [
            'meta_title' => config('app.name'),
            'meta_description' => '',
        ];
    }

    protected static function fill($template, $values){
        return preg_replace_callback('/\{(\w+)\}/', function ($m) use ($values) {
            return $values[$m[1]] ?? '';
        }, $template);
    }

    protected static function formatValue($key, $raw)
    {
        return match ($key) {
            'state' => strtoupper($raw),
            'listingId', 'profileId' => $raw, // as-is, case-sensitive IDs
            default => ucfirst(str_replace('-', ' ', $raw)),
        };
    }

    public static function resolve($module, $path = ''){
        $segments = array_values(array_filter(explode('/', trim($path, '/')), fn($s) => $s !== ''));
        $count = count($segments);


        $levels = config("seo_templates.{$module}.levels", []);
        $level = $levels[$count] ?? '';

        if(!$level) {
            return self::fallback();
        } 

        $segmentMap = config("seo_templates.{$module}.segment_map.{$level}", []);
        $template   = config("seo_templates.{$module}.templates.{$level}");


        $values = [];
        foreach($segmentMap as $index  => $key){
            $values[$key] = self::formatValue($key, $segments[$index] ?? '');
        }


        if (!empty($values['listingId'])) {
            $values['name'] = $values['listingId'] ?? '';
        }


        

        if (!empty($values['profile'])) {
            $listing = Escort::where('slug', $values['profile'])->first();
            if($listing){
                 $values['name'] = $listing->name ?? '';
            }
           
        }


        if(empty($values['country'])){
            $values['country'] = config('seo_templates.default_country', 'Australia');
        }



        return (object) [
            'meta_title' => self::fill($template['title'], $values),
            'meta_description' => self::fill($template['description'], $values),
            'og_image' => $template['og_image']
        ]; 
    }
}