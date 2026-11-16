<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('about-pos', function () { $this->comment('POS TFA8 resource controllers and authentication activity.'); })->purpose('Display activity information');
