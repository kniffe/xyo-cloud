<?php
//
// Copyright (c) 2014 Grigore Stefan, <g_stefan@yahoo.com>
// Created by Grigore Stefan <g_stefan@yahoo.com>
//
// The MIT License (MIT) <http://opensource.org/licenses/MIT>
//

defined('XYO_CLOUD') or die('Access is denied');

echo "<a href=\"".$this->requestUriModule("xyo-com-logout", array("stamp"=>md5(time().rand())))."\"><div style=\"position:relative;width:2em;height:1em;\"><i class=\"fa fa-sign-out\" style=\"color:#ccc;font-size:32px;position:absolute;top:-9px;\"></i></div></a>";