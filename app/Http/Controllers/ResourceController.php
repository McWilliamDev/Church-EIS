<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResourceController extends Controller
{
    public function index()
    {
        $resources = DB::table('church_resources')
            ->where('is_delete', 0)
            ->get();

        return view('website.resources', ['resources' => $resources]);
    }
}
