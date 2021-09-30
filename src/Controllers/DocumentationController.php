<?php

namespace g4t\Documentation\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class DocumentationController extends Controller
{






    public function routesInfo()
    {
        $routes = collect(Route::getRoutes())->map(function ($route) {
            if(key_exists('controller', $route->getAction())) {
            $controller = $route->getAction()['controller'];
            $pieces = explode("@", $controller);
            if ($pieces[0] !== 'g4t\Documentation\Controllers\DocumentationController') {
                $middleware = $route->getAction()['middleware'];
                if (in_array('api', $middleware)) {
                    $file = $pieces[0] . '.php';
                    $url = $route->uri();
                    preg_match_all("/\\{(.*?)\\}/", $url, $params);
                    $data['url'] = url($url);
                    $data['short_url'] = $url;
                    $data['index'] = 'index_' . rand(9999, 9999999);
                    $data['controller'] = $pieces[0];
                    $data['params'] = $params[0];
                    $data['method'] = $route->methods()[0];
                    $body = $this->getBody($file, $pieces[1]);
                    $data['auth'] = in_array('auth:api', $middleware) ? true : $body['auth'];
                    $data['function'] = $body['title'] ? $body['title'] : $pieces[1];
                    $data['body'] = $body['body'];
                    return $data;
                }
            }
        }
        return null;
        });
        foreach($routes as $route) {
            if($route !== null) {
                $result[] = $route;
            }
        }
        return $result;
    }



    public function readFile($file)
    {
        $myfile = fopen($file, "r") or die("Unable to open file!");
        $ss = fread($myfile, filesize($file));
        $ss = str_replace('<?php', '', $ss);
        return $ss;
        fclose($myfile);
    }




    public function get_string_between($string, $start, $end)
    {
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }




    public function get_key_and_value($parsed)
    {
        $explode = [];
        $array = explode("*", $parsed);
        foreach ($array as $key => $value) {
            $k1 = trim($value);
            $k = ltrim($k1);
            if ($k !== '') {
                $result = explode(" ", $k);
                if ($result[0] !== 'auth' and count($result) <= 3 and count($result) !== 0) {
                    $explode[] = [
                        'type' => $result[0],
                        'key' => str_replace('$', '', $result[1]),
                        'required' => count($result) == 3 ? true : false,
                    ];
                }
            }
        }
        return $explode;
    }

    public function getAuth($parsed)
    {
        $auth = false;
        $array = explode("*", $parsed);
        foreach ($array as $value) {
            $k1 = trim($value);
            $k = ltrim($k1);
            if ($k == 'auth') {
                $auth = true;
            }
        }
        return $auth;
    }


    public function getTitle($parsed)
    {
        $title = null;
        $array = explode("*", $parsed);
        foreach ($array as $key => $value) {
            $k1 = trim($value);
            $k = ltrim($k1);
            if ($k !== '') {
                $result = explode(" ", $k);
                if ($result[0] == 'title:') {
                    for ($i=0; $i < count($result); $i++) {
                        if($i > 0) {
                            $title .= $result[$i]. ' ';
                        }
                    }
                }
            }
        }
        return $title;
    }



    public function getBody($file, $function)
    {
        $file = base_path($file);
        $readController = $this->readFile($file);
        $parsed = $this->get_string_between($readController, 'start ' . $function . ' function', 'end ' . $function . ' function');
        $body = $this->get_key_and_value($parsed);
        $auth = $this->getAuth($parsed);
        $title = $this->getTitle($parsed);
        return [
            'body' => $body,
            'auth' => $auth,
            'title' => $title
        ];
    }





    public function index()
    {
        $styles = public_path().'/g4t';
        $config = config_path().'/documentation.php';
        if (!file_exists($styles) or !(file_exists($config))) {
            return response()->json([
                "message" => "some files not found !",
                "solution" => "php artisan vendor:publish --provider=g4t\Documentation\DocumentationServiceProvider"
            ], 404);
        }
        return $this->routesInfo();
    }



    public function web()
    {
        $styles = public_path().'/g4t';
        $config = config_path().'/documentation.php';
        if (!file_exists($styles) or !(file_exists($config))) {
            return response()->json([
                "message" => "some files not found !",
                "solution" => "php artisan vendor:publish --provider=g4t\Documentation\DocumentationServiceProvider"
            ], 404);
        }
        $docs = $this->routesInfo();
        return view('documentation::web', [
            'docs' => $docs
        ]);
    }
}
