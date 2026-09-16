<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;

class ServiceApiController extends Controller
{
    /**
     * Public read-only catalog of active services, for the site to render.
     */
    public function index()
    {
        return Service::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
    }

    public function show(Service $service)
    {
        abort_unless($service->is_active, 404);

        return $service;
    }
}
