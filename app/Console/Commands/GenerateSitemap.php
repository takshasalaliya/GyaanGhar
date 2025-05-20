<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Kreait\Firebase\Factory;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:firebase';
    protected $description = 'Generate sitemap for Firebase data';

    public function handle()
    {
        $firebaseCredentialsPath = storage_path('firebase/firebase.json');
        $databaseUrl = 'https://final-laravel-project-default-rtdb.firebaseio.com';

        $factory = (new Factory)
            ->withServiceAccount($firebaseCredentialsPath)
            ->withDatabaseUri($databaseUrl);

        $database = $factory->createDatabase();

        $classes = $database->getReference('classes')->getValue();

        if (!$classes) {
            $this->warn("⚠️ No classes found in Firebase.");
            return;
        }

        $this->info("✅ Fetched classes from Firebase. Creating sitemap...");

        $sitemapContent = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $sitemapContent .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($classes as $class) {
            if (isset($class['classCode'])) {
                $url = url('/class/' . $class['classCode']); // Update route as per your frontend
                $sitemapContent .= "  <url>\n";
                $sitemapContent .= "    <loc>{$url}</loc>\n";
                $sitemapContent .= "    <changefreq>weekly</changefreq>\n";
                $sitemapContent .= "    <priority>0.8</priority>\n";
                $sitemapContent .= "  </url>\n";
            }
        }

        $sitemapContent .= '</urlset>';

        file_put_contents(public_path('sitemap.xml'), $sitemapContent);

        $this->info("✅ Sitemap saved to: " . public_path('sitemap.xml'));
    }
}
