<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Response;


class MainController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Responce
    {
        return view('main');
    }
}
