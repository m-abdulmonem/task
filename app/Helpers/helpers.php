<?php

use App\Models\Product\Orders;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

if (!function_exists("is_email")) {
    function is_email($var)
    {
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }
}


if (!function_exists("_assets")) {
    function _assets($path, $folder, $plugin = null, bool $fullPath = false): string
    {
        $assets = "assets/$folder/";

        $imgTypes = ['jpeg', 'jpg', 'png', 'ico', 'svg'];
        $extension = array_reverse(explode(".", $path));

        if ($fullPath) {
            return asset($assets . "plugin/$plugin/$path");
        }
        if ($plugin) {
            $pluginFolder = is_string($plugin) ? $plugin : $extension[count($extension) - 1];
            return asset($assets . "plugin/$pluginFolder/" . $extension[0] . "/$path");
        }
        if (in_array($extension[0], $imgTypes)) {
            return asset($assets . "img/$path");
        }
        return asset($assets . $extension[0] . "/$path");
    }
}

if (!function_exists("admin_assets")) {
    function admin_assets($path, $plugin = null, bool $fullPath = false): string
    {
        return _assets($path, "dashboard", $plugin, $fullPath);
    }
}

if (!function_exists("frontend_assets")) {
    /**
     * @param $path
     * @param string|null $plugin
     * @param false $fullPath
     * @return string
     */
    function frontend_assets($path, string $plugin = null, bool $fullPath = false): string
    {
        return _assets($path, "frontend", $plugin, $fullPath);
    }
}


if (!function_exists("title")) {
    function title($title): ?string
    {
        return $title ? "$title - ": null;
    }
}

if (! function_exists("json")){

    /**
     *
     * status 1 mean success
     * status 0 mean fail
     *
     * @param $msg
     * @param $status
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    function json($msg = null,$status = null,$data = null){
        return response()->json(['status' => $status,'msg' => $msg,'data' => $data]);
    }
}
