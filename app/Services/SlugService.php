<?php

namespace App\Services;

use App\Models\Escort;
use App\Models\MassageProfile;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
class SlugService
{
    /**
     * Create or update slug
     * 
     * @param object $modelObject
     * @param return string
     */
    public function createUpdateSlug($modelObject = null, $type = "old")
    {
        $slug = '';
        try {
            if (!$modelObject) {
                return  $slug;
            } else if ($type == 'old' && !empty($modelObject->slug)) { 
                // Do not update slug if already exist
                return  $slug;
            }
            $calssName = $this->getClassName($modelObject);
            $baseSlug = '';
            $id = $modelObject->id;
            $createdDate = $modelObject->created_at;
            $year = Carbon::parse($createdDate)->format('y');

            if ($calssName == 'Escort') {
                $baseSlug = 'E' . $year;

                //$baseSlug = isset($modelObject->name) ?  $modelObject->name : $modelObject->profile_name;
                //$baseSlug = !empty($baseSlug) ? Str::slug($baseSlug) : 'escort';
            } else if ($calssName == 'MassageProfile') {
                $baseSlug = 'M' . $year;
                //$baseSlug = isset($modelObject->business_name) ?  $modelObject->business_name : $modelObject->profile_name;
                //$baseSlug = !empty($baseSlug) ?  Str::slug($baseSlug) : 'massage';
            }
            $slug = $baseSlug . $this->generateSequenceNumber($id);


            while ($modelObject->newQuery()
                ->where('slug', $slug)
                ->where('id', '!=', $modelObject->id)
                ->exists()
            ) {
                $slug = $baseSlug . random_string('nozero', 2);
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
            Escort::chunkById(25, function ($escorts) {
                    foreach ($escorts as $escort) {
                        // Process each escort
                        $this->createUpdateSlug($escort, 'new');
                    }
                });

            MassageProfile::chunkById(25, function ($massges) {
                    foreach ($massges as $massge) {
                        // Process each massge
                        $this->createUpdateSlug($massge, 'new');
                    }
                });
        } catch (Exception $e) {
            Log::info('Advertiser slug not updated: ' . $e->getMessage());
        }
        return true;
    }

    function generateSequenceNumber($number, $digits = 5)
    {
        return str_pad($number, $digits, '0', STR_PAD_LEFT);
    }
}
