<?php
//
// Copyright (c) 2014 Grigore Stefan, <g_stefan@yahoo.com>
// Created by Grigore Stefan <g_stefan@yahoo.com>
//
// The MIT License (MIT) <http://opensource.org/licenses/MIT>
//

defined('XYO_CLOUD') or die('Access is denied');

$className = "lib_mod_JQueryFixedHeaderTable";

class lib_mod_JQueryFixedHeaderTable extends xyo_Module {

    public function __construct(&$object, &$cloud) {
        parent::__construct($object, $cloud);
        if ($this->isBase("lib_mod_JQueryFixedHeaderTable")) {
            $htmlFooter = &$cloud->getModule("xyo-mod-htmlfooter");
            if ($htmlFooter) {
                $htmlFooter->setJs($this->name,$this->site."media/sys/js/jquery.stickytableheaders.min.js");
            } else {
                $this->moduleDisable();
            };
        }
    }
}
