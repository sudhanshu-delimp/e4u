<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoMeta extends Model
{
    use HasFactory;

    protected $table = 'seo_metas';

    protected $fillable = [
        'id', 'route_name', 'seo_label', 'url', 'meta_title', 'meta_description', 'og_title',
        'og_description', 'og_image', 'schema_json', 'page_content', 'sitemap_include', 'is_active',
        'schema_script', 'robots_txt'
    ];
}
