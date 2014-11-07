<?php
//
// Copyright (c) 2014 Grigore Stefan, <g_stefan@yahoo.com>
// Created by Grigore Stefan <g_stefan@yahoo.com>
//
// The MIT License (MIT) <http://opensource.org/licenses/MIT>
//

defined('XYO_CLOUD') or die('Access is denied');

$this->setParameter("form_title","form_title_edit");
$this->generateElement("form-begin");
$this->generateView("form");
$this->generateElement("form-end",null,array(
	"parameters"=>array(
		"action"=>"table-dialog-edit-apply",
		$this->getElementName("primary_key_value") => $this->getElementValue("primary_key_value", ""),
		"ajax"=>1
	)
));
