<?php
//
// Copyright (c) 2014 Grigore Stefan, <g_stefan@yahoo.com>
// Created by Grigore Stefan <g_stefan@yahoo.com>
//
// The MIT License (MIT) <http://opensource.org/licenses/MIT>
//

defined('XYO_CLOUD') or die('Access is denied');

$allOk = true;
$this->setView("datasource");
$this->clearElementError();
$layer = $this->getElementValue("layer");
if ($layer === "mysql" || $layer === "postgresql" ) {
    $server = $this->getElementValueStr("server");
    if (strlen($server) == 0) {
        $this->setElementError("server", $this->getFromLanguage("server_empty"));
    }

    $port = $this->getElementValueStr("port");
    if (strlen($port) == 0) {		
		$port=0;
    }
	if(1*$port){}else{
		if($layer === "mysql"){
			$port="3306";
		};
		if($layer === "postgresql"){
			$port="5432";
		};
	};

	$this->setElementValue("port",$port);
	

    $username = $this->getElementValueStr("username");
    if (strlen($username) == 0) {
        $this->setElementError("username", $this->getFromLanguage("username_empty"));
    }

    $database = $this->getElementValueStr("database");
    if (strlen($database) == 0) {
        $this->setElementError("database", $this->getFromLanguage("database_empty"));
    }
}

$this->processModel("datasource-config");

if ($this->isError()) {
    $this->doRedirect("datasource");
} else {
    $this->doRedirect("install");
}
