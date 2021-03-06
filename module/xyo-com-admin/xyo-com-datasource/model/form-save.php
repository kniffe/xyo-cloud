<?php
//
// Copyright (c) 2014 Grigore Stefan, <g_stefan@yahoo.com>
// Created by Grigore Stefan <g_stefan@yahoo.com>
//
// The MIT License (MIT) <http://opensource.org/licenses/MIT>
//

defined('XYO_CLOUD') or die('Access is denied');

$connection=$this->getElementValueStr("connection","*");
$datasource=$this->getElementValueStr("datasource","*");
$option=$this->getElementValueStr("option","*");

if(strlen($datasource)>0){
	if($datasource!="*"){
		if(strlen($option)>0){		
			if($option!="*"){
				$ds=&$this->getDataSource($datasource);

				if ($ds) {
					if ($option == "create") {
						$ds->createStorage();
						$this->setMessage("info","datasource_create");
					} else
					if ($option == "recreate") {
						$ds->recreateStorage();
						$this->setMessage("info","datasource_recreate");
					} else
					if ($option == "destroy") {
						$ds->destroyStorage();
						$this->setMessage("info","datasource_destroy");
					};
				};
			};
		};
	};
};

$this->setElementValue("option","*");
