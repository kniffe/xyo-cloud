<?php
//
// Copyright (c) 2014 Grigore Stefan, <g_stefan@yahoo.com>
// Created by Grigore Stefan <g_stefan@yahoo.com>
//
// The MIT License (MIT) <http://opensource.org/licenses/MIT>
//

defined('XYO_CLOUD') or die('Access is denied');

$router=$this->getParameter("router",$this->ds->name);
$core=$this->getParameter("core",$this->ds->name);
$coreDef=str_replace("-","_",$core);

$file = $this->cloud->get("path_base_absolute") . $router . ".php";
$fs = fopen($file, "w");
if ($fs) {
    fwrite($fs, "<" . "?" . "php\r\n");
    fwrite($fs, "//\r\n");
    fwrite($fs, "// Generated by xyo-com-core\r\n");
    fwrite($fs, "//\r\n");
    fwrite($fs, "define(\"XYO_CLOUD_" . strtoupper($coreDef) . "\",1);\r\n");
    fwrite($fs, "require_once(\"xyo/xyo-cloud.php\");\r\n");
    fwrite($fs, "\$xyoCloud=new xyo_Cloud(dirname(realpath(__FILE__)).\"/\");\r\n");
    fwrite($fs, "defined('XYO_CLOUD') or die('Access is denied');\r\n");
    fwrite($fs, "\$xyoCloud->set(\"request_main\",\"" . strtolower($router) . ".php\");\r\n");
    fwrite($fs, "\$xyoCloud->set(\"system_core\",\"" . $core . "\");\r\n");
    fwrite($fs, "\$xyoCloud->main();\r\n");
    fclose($fs);
} else {
    $this->setError("error", array("err_unable_to_write_file" => $file));
}