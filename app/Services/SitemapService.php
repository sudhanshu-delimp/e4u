<?php

namespace App\Services;

use DOMDocument;
use DOMXPath;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class SitemapService
{
    protected string $path;

    public function __construct()
    {
        $this->path = public_path('sitemap.xml');
    }

 
    public function sync(array $data): void
    {
        $url = $this->resolveUrl($data['route_name'] ?? null);
        if (!$url) {
            return; // route doesn't exist / was deleted — nothing to do
        }
 
        $include = (int) ($data['sitemap_include'] ?? 0) === 1;
 
        $dom = $this->loadDocument();
        $xpath = new DOMXPath($dom);
        $xpath->registerNamespace('s', 'http://www.sitemaps.org/schemas/sitemap/0.9');
 
        // Step 1: remove existing entry for this page, if any
        $existingNode = $this->findUrlNode($xpath, $url);
        if ($existingNode) {
            $existingNode->parentNode->removeChild($existingNode);
        }
 
        // Step 2: checkbox unchecked → just save the removal and stop
        if (!$include) {
            $this->save($dom);
            return;
        }
 

       // $priority   = $data['sitemap_priority'] ?? 0.5;
        //$changefreq = $data['sitemap_changefreq'] ?? 'weekly';
        $lastmod    = now()->toAtomString();
 
        $urlset = $dom->documentElement;
        $urlNode = $dom->createElement('url');
 
        $urlNode->appendChild($dom->createElement('loc', htmlspecialchars($url, ENT_XML1)));
        $urlNode->appendChild($dom->createElement('lastmod', $lastmod));
        //$urlNode->appendChild($dom->createElement('changefreq', $changefreq));
        //$urlNode->appendChild($dom->createElement('priority', (string) $priority));
 
        $urlset->appendChild($urlNode);
 
        $this->save($dom);
    }

  
    // public function regenerate(iterable $rows): int
    // {
    //     $dom = $this->newDocument();
    //     $urlset = $dom->documentElement;
    //     $count = 0;

    //     foreach ($rows as $row) {
    //         $url = $this->resolveUrl($row->route_name ?? null);
    //         if (!$url) {
    //             continue;
    //         }

    //         $urlNode = $dom->createElement('url');
    //         $urlNode->appendChild($dom->createElement('loc', htmlspecialchars($url, ENT_XML1)));
    //         $urlNode->appendChild($dom->createElement('lastmod', optional($row->updated_at)->toAtomString() ?? now()->toAtomString()));
    //         $urlNode->appendChild($dom->createElement('changefreq', $row->sitemap_changefreq ?? 'weekly'));
    //         $urlNode->appendChild($dom->createElement('priority', (string) ($row->sitemap_priority ?? 0.5)));

    //         $urlset->appendChild($urlNode);
    //         $count++;
    //     }

    //     $this->save($dom);

    //     return $count;
    // }





    // ---------------------------------------------------------------
    // Internals
    // ---------------------------------------------------------------

    protected function resolveUrl($routeName)
    {
        if (!$routeName) {
            return null;
        }

        try {
            return route($routeName);
        } catch (\Throwable $e) {
            Log::warning("Sitemap: route [{$routeName}] no longer exists, skipping.");
            return null;
        }
    }

    protected function loadDocument()
    {
        if (!File::exists($this->path) || File::size($this->path) === 0) {
            return $this->newDocument();
        }

        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;

        libxml_use_internal_errors(true);
        $loaded = $dom->load($this->path);
        libxml_clear_errors();

        if (!$loaded || !$dom->documentElement) {
            Log::warning("Sitemap: {$this->path} was invalid/corrupt, starting fresh.");
            return $this->newDocument();
        }
 
        return $dom;


        // $dom->load($this->path);
        // return $dom;
    }


    protected function newDocument()
    {
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = true;

        $urlset = $dom->createElementNS('http://www.sitemaps.org/schemas/sitemap/0.9', 'urlset');
        $dom->appendChild($urlset);
        return $dom;
    }

    protected function findUrlNode(DOMXPath $xpath, string $url)
    {
        $nodes = $xpath->query("//s:url[s:loc='" . $url . "']");
        return $nodes->length > 0 ? $nodes->item(0) : null;
    }

    protected function setChildValue(\DOMElement $parent, string $tag, string $value): void
    {
        foreach ($parent->childNodes as $child) {
            if ($child->nodeName === $tag) {
                $child->nodeValue = htmlspecialchars($value, ENT_XML1);
                return;
            }
        }
        $parent->appendChild($parent->ownerDocument->createElement($tag, htmlspecialchars($value, ENT_XML1)));
    }

    protected function save(DOMDocument $dom)
    {
        $tmp = $this->path . '.tmp';
        File::put($tmp, $dom->saveXML());
        File::move($tmp, $this->path);
    }
}
