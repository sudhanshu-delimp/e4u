<?php

namespace App\Services;

use App\Models\Escort;
use App\Models\MassageProfile;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SlugService
{
    /**
     * Create or update slug
     * 
     * @param object $modelObject
     * @param return string
     */
    public function createUpdateSlug($modelObject = null)
    {
        $slug = '';
        try {
            $calssName = $this->getClassName($modelObject);
            $baseSlug = '';
            if ($calssName == 'Escort') {
                $baseSlug = isset($modelObject->profile_name) ?  $modelObject->profile_name : $modelObject->name;
                $baseSlug = !empty($baseSlug) ? Str::slug($baseSlug) : 'escort';
            } else if ($calssName == 'MassageProfile') {
                $baseSlug = isset($modelObject->business_name) ?  $modelObject->business_name : $modelObject->profile_name;
                $baseSlug = !empty($baseSlug) ?  Str::slug($baseSlug) : 'massage';
            }
            $slug = $baseSlug;


            while ($modelObject->newQuery()
                ->where('slug', $slug)
                ->where('id', '!=', $modelObject->id)
                ->exists()
            ) {
                $slug = $baseSlug . '-' . random_string('nozero', 4);
            }
            if (!empty($slug)) {
                $modelObject->slug = $slug;
                $modelObject->save();
            }
        } catch (Exception $e) {
            Log::info('Slug: ' . $e->getMessage());
        }
        return $slug;
    }

    private function getClassName($modelObject)
    {
        $column = "";
        switch (class_basename($modelObject)) {
            case 'Escort':
                $column = 'Escort';
                break;

            case 'MassageProfile':
                $column = 'MassageProfile';
                break;
            default:
                $column = '';
                break;
        }
        return $column;
    }

    /**
     * Update slug of existing profile;
     * 
     */

    public function updateSlugExistingProfile()
    {
        try {
            Escort::whereNull('slug')
                ->orWhere('slug', '')
                ->chunkById(25, function ($escorts) {
                    foreach ($escorts as $escort) {
                        // Process each escort
                        $this->createUpdateSlug($escort);
                    }
                });

            MassageProfile::whereNull('slug')
                ->orWhere('slug', '')
                ->chunkById(25, function ($massges) {
                    foreach ($massges as $massge) {
                        // Process each massge
                        $this->createUpdateSlug($massge);
                    }
                });
        } catch (Exception $e) {
            Log::info('Advertiser slug not updated: ' . $e->getMessage());
        }
        return true;
    }
}
