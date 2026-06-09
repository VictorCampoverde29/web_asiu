<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class SitemapController extends BaseController
{
    public function index()
    {
        $baseURL = 'https://grupoasiu.com/';

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Página de inicio
        $xml .= $this->addUrl($baseURL, '1.00', 'daily', date('Y-m-d'));

        // Página Inicio (alias)
        $xml .= $this->addUrl($baseURL . 'inicio', '0.80', 'daily', date('Y-m-d'));

        // Quienes Somos
        $xml .= $this->addUrl($baseURL . 'quienes-somos', '0.80', 'monthly', date('Y-m-d'));

        // Servicios
        $xml .= $this->addUrl($baseURL . 'servicios', '0.80', 'monthly', date('Y-m-d'));

        // Contacto
        $xml .= $this->addUrl($baseURL . 'contacto', '0.70', 'monthly', date('Y-m-d'));

        $xml .= '</urlset>';

        return $this->response
            ->setContentType('application/xml')
            ->setBody($xml);
    }

    private function addUrl(string $loc, string $priority, string $changefreq, string $lastmod): string
    {
        $url = '<url>';
        $url .= '<loc>' . htmlspecialchars($loc, ENT_XML1, 'UTF-8') . '</loc>';
        $url .= '<lastmod>' . $lastmod . '</lastmod>';
        $url .= '<changefreq>' . $changefreq . '</changefreq>';
        $url .= '<priority>' . $priority . '</priority>';
        $url .= '</url>';

        return $url;
    }
}
