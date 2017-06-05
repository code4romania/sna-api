<?php

namespace App\Api\V1\CORS;

trait Headers {
    
    function getHeaders() {
        return array('Access-Control-Allow-Origin' => '*');
    }
    
}