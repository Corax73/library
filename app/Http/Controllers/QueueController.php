<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ParseForQueue;

class QueueController extends Controller
{
    public function jobs() : void
    {
        ParseForQueue::dispatch();
    }
}
