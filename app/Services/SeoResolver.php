<?php

namespace App\Services;

use App\Models\Escort;
use App\Models\MassageProfile;

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
            'state' => trim((string) $raw),
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



        if (!empty($values['profileId'])) {
           $listing = Escort::where('slug', $values['profileId'])->first();
            if($listing){
                 $values['pro_name'] = $listing->name ?? '';
            }
        }

        //For Massage Center

        if (!empty($values['MprofileId'])){
            $msPro = MassageProfile::where('slug', $values['MprofileId'])->first();
            if($msPro){
                $values['mc_pro_name'] = $msPro->business_name ?? '';
            }
        }


        
        if (!empty($values['listingId'])) {
             $values['name'] = $values['listingId'] ?? '';
        }


        if(empty($values['country'])){
            $values['country'] = config('seo_templates.default_country', 'Australia');
        }


      
        if (!empty($values['state'])) {
            $values['state'] = getStateAbbrName(strtoupper($values['state']));
        }

        if(!empty($values['gender'])) {
            if(mb_strlen($values['gender']) <= 3){
                $values['gender'] = getStateAbbrName(strtoupper($values['gender']));
            }
        }

        return (object) [
            'meta_title' => self::fill($template['title'], $values),
            'meta_description' => self::fill($template['description'], $values),
            'og_image' => $template['og_image']
        ]; 
    }
}