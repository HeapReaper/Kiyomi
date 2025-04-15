<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateSiteMap extends Command
{
    protected $signature = 'app:generate-site-map';

    protected $description = 'Command description';

    public function handle()
    {
        $this->info('Generating site map...');
    }
}
