<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use MetaTag;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {
        // Defaults
        MetaTag::set('title', 'FRESHMOVIES4U | Watch movies and tv-series online for free');
        MetaTag::set('description', 'Watch Free Online Movies and Tv-series for free');
        MetaTag::set('image', asset('images/titlecon.png'));
    }
}
