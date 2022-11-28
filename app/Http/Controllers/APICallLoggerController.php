<?php

namespace App\Http\Controllers;

use App\Models\APICallLogger;

class APICallLoggerController extends Controller
{
    public function __construct($type) {
        $apicalllogger = new APICallLogger();
        $apicalllogger->call_type = $type;
        $apicalllogger->save();
    }
}
