<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
//     protected function createGateUnauthorizedException(
//     $ability,
//     $arguments,
//     $message = 'This action is unauthorized.',
//     $previousException = null
// ) {
//     throw $previousException;
// }
}
