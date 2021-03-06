<?php
//
// Copyright (c) 2014 Grigore Stefan, <g_stefan@yahoo.com>
// Created by Grigore Stefan <g_stefan@yahoo.com>
//
// The MIT License (MIT) <http://opensource.org/licenses/MIT>
//

defined('XYO_CLOUD') or die('Access is denied');

$name = $this->getElementValueStr("name");
if (strlen($name) == 0) {
    $this->setElementError("name", $this->getFromLanguage("el_name_empty"));
}

if ($this->isElementError()) {
    return;
};

$id_xyo_core = $this->getElementValueInt("id_xyo_core", 0, "*");

$found=false;
$this->ds->clear();
$this->ds->name = $name;
if ($this->ds->load(0, 1)) {
	$found=true;
};

if ($found) {
    if ($this->isNew) {
        $this->setElementError("name", $this->getFromLanguage("el_name_already_exists"));
        return;
    } else {
        if ($this->ds->id != $this->primaryKeyValue) {
            $this->setElementError("name", $this->getFromLanguage("el_name_already_exists"));
            return;
        }
    }
}

if ($this->isNew) {
    
} else {
    $this->ds->clear();
    $this->ds->id = $this->primaryKeyValue;
    if ($this->ds->load(0, 1)) {
        
    } else {
        $this->setError("error", array("id_user_not_found" => $this->primaryKeyValue));
        return;
    }
}

$this->ds->name = $name;
$this->ds->description = $this->getElementValueStr("description");
$this->ds->enabled = $this->getElementValueInt("enabled", 0, "*");

if ($this->ds->save()) {
    
} else {
    $this->setError("error", "err_save_error");
    return;
}
