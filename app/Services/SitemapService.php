<?php

namespace App\Services;

use App\Models\Escort;
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
        $this->syncUrl($url, $include);
    }

    public function syncEscortProfile(Escort $escort, bool $include): void
    {
        $url = $this->resolveEscortProfileUrl($escort);
        if (!$url) {
            return;
        }

        $this->syncUrl($url, $include);
    }

    protected function resolveEscortProfileUrl(Escort $escort): ?string
    {
        if (empty($escort->slug)) {
            return null;
        }

        $url = getAdvertiserDetailUrl($escort, 'escort');
        return $url === 'javascript:void(0)' ? null : $url;
    }

    protected function syncUrl(string $url, bool $include): void
    {
 
        $dom = $this->loadDocument();
        $xpath = new DOMXPath($dom);
        $xpath->registerNamespace('s', 'http://www.sitemaps.org/schemas/sitemap/0.9');
 
        foreach ($this->findUrlNodes($xpath, $url) as $existingNode) {
            $existingNode->parentNode->removeChild($existingNode);
        }
 
        if (!$include) {
            $this->save($dom);
            return;
        }
 
        $this->appendUrlNode($dom, $url);
        $this->save($dom);
    }

    protected function appendUrlNode(DOMDocument $dom, string $url): void
    {
        $urlNode = $dom->createElement('url');
        $locNode = $dom->createElement('loc');
        $locNode->appendChild($dom->createTextNode($url));
        $urlNode->appendChild($locNode);
        $urlNode->appendChild($dom->createElement('lastmod', now()->toAtomString()));
        $dom->documentElement->appendChild($urlNode);
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

    protected function findUrlNodes(DOMXPath $xpath, string $url): array
    {
        $matches = [];
        foreach ($xpath->query('//s:url') as $urlNode) {
            $locNodes = $xpath->query('./s:loc', $urlNode);
            if ($locNodes->length > 0 && $locNodes->item(0)->textContent === $url) {
                $matches[] = $urlNode;
            }
        }

        return $matches;
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
