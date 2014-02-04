<?php
return array(
	'_root_'  => 'top/index',  // The default route
	'_404_'   => 'top/404',    // The main 404 route
        'search' => 'top/search',
    
        'user_regist/(:any)' => 'register/user/$1',
        'artist_regist/(:any)' => 'register/artist/$1',
        'auth/(:any)' => 'auth/$1',
);