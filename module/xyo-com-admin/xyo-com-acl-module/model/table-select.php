<?php
//
// Copyright (c) 2014 Grigore Stefan, <g_stefan@yahoo.com>
// Created by Grigore Stefan <g_stefan@yahoo.com>
//
// The MIT License (MIT) <http://opensource.org/licenses/MIT>
//

defined('XYO_CLOUD') or die('Access is denied');

if($this->id_xyo_module){
    $this->ds->id_xyo_module=$this->id_xyo_module;
}

if($this->id_xyo_module_group){
    $this->ds->id_xyo_module_group=$this->id_xyo_module_group;
}


$this->ds->setGroup("id",true);
$this->ds->setGroup("module_name",true);
$this->ds->setGroup("module_group_name",true);
$this->ds->setGroup("user_group_name",true);
$this->ds->setGroup("core_name",true);
