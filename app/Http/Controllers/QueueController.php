<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ParseForQueue;

class QueueController extends Controller
{
    /**
     * task to add books to the database from a file
     * @return \Illuminate\Http\RedirectResponse
     */
    public function jobs() : \Illuminate\Http\RedirectResponse
    {
        ParseForQueue::dispatch();
        return redirect()->route('manageBooks');
    }
}
