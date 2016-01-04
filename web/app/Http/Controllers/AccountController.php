<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Redis;

class AccountController extends Controller
{
	public function index () {
	}

	public function balance () {
		return getJsonFromRedisAndReturn('balance');
	}

	public function position () {
		return getJsonFromRedisAndReturn('position');
	}

	public function entrust () {
		return getJsonFromRedisAndReturn('entrust');
	}
}
