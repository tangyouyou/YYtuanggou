<?php 

 function p($array){
 	dump($array,1,'<pre>',0);
 }

 function url_param_remove($var, $url = null)
{
	import('Class.Route',APP_PATH);
    return Route::removeUrlParam($var,$url);
}


?>