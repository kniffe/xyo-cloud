<?php
//
// Copyright (c) 2014 Grigore Stefan, <g_stefan@yahoo.com>
// Created by Grigore Stefan <g_stefan@yahoo.com>
//
// The MIT License (MIT) <http://opensource.org/licenses/MIT>
//

defined('XYO_CLOUD') or die('Access is denied');
//
// this code will push request to force login
//
if($this->user->isAuthorized()){
}else{
		$request=$this->getRequestDirect();
		$module=$this->moduleFromRequest($request);
		if($module=="xyo-com-login"){
		}else{
			$this->setRequestDirect($this->callRequest($this->requestModuleDirect($module),$request));
		};
		$this->setComponent("xyo-com-login");
};