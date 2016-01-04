<?php
function getJsonFromRedisAndReturn ($name) {
	$json = Redis::get($name);
	return response($json)->header('Content-Type', 'application/json');
}
