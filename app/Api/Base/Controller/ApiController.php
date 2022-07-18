<?php 

namespace App\Api\Base\Controller;

use App\Api\Base\Responses\ApiClientResponse;
use Closure;
use Illuminate\Routing\Controller as BaseController;

class ApiController extends BaseController
{
    use ApiClientResponse;
}