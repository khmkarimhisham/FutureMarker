<?php

namespace App\Http\Controllers;

class DownloadAppController extends Controller
{
    public function index()
    {

        return response()->download("Mobile App/Future Marker.apk");

    }
}
