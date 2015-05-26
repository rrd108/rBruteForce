<?php
use Cake\Routing\Router;

Router::plugin('RBruteForce', function($routes) {
	$routes->fallbacks('InflectedRoute');
});
