<?php
//
// Copyright (c) 2014 Grigore Stefan, <g_stefan@yahoo.com>
// Created by Grigore Stefan <g_stefan@yahoo.com>
//
// The MIT License (MIT) <http://opensource.org/licenses/MIT>
//

defined('XYO_CLOUD') or die('Access is denied');

$className = "xyo_mod_ds_Acl";

class xyo_mod_ds_acl_Info {

	public $aclUserGroup; // any and user groups
	public $aclCore; // any and core
	public $aclUser; // any and user id
	public $aclUserId; // only user id

}

class xyo_mod_ds_Acl extends xyo_Module {

	protected $acl;
	protected $dsCore;
	protected $dsUser;
	protected $dsUserGroup;
	protected $dsUserGroupXUserGroup;
	protected $dsUserXUserGroupSuper;
	protected $dsAclProperty;

	protected $aclCore;

	function __construct(&$object, &$cloud) {
		parent::__construct($object, $cloud);
		if ($this->isOk) {
			$this->reloadDataSource();
			$this->acl = &$this->getDefaultAcl();
			$this->aclCore = null;
		}
	}

	public function &getDefaultAcl() {
		$retV = new xyo_mod_ds_acl_Info;
		$retV->aclUserGroupLevel1 = 0;
		$retV->aclUserGroupLevel2 = 0;
		$retV->aclCore = 0;
		$retV->aclUser = 0;
		$retV->aclUser1 = 0;
		return $retV;
	}

	public function reloadDataSource() {

		$modDs = &$this->getModule("xyo-mod-datasource");
		if ($modDs) {

			$this->dsCore = &$modDs->getDataSource("db.table.xyo_core");
			$this->dsUser = &$modDs->getDataSource("db.table.xyo_user");
			$this->dsUserGroup = &$modDs->getDataSource("db.table.xyo_user_group");
			$this->dsUserGroupXUserGroup = &$modDs->getDataSource("db.table.xyo_user_group_x_user_group");
			$this->dsUserXUserGroup = &$modDs->getDataSource("db.table.xyo_user_x_user_group");

		}

	}

	public function getAclSysCore() {
		if($this->aclCore) {
			return $this->aclCore[1];
		};

		$dsCore = &$this->dsCore->copyThis();
		$dsCore->clear();
		$dsCore->name = $this->cloud->get("system_core");
		$dsCore->enabled = 1;
		if ($dsCore->load(0, 1)) {
			$this->aclCore = array(1=>array(0, $dsCore->id));
		} else {
			$this->aclCore = array(1=>0);
		}
		return $this->aclCore[1];
	}

	public function &getUserIdAcl($id_xyo_user) {
		if ($this->dsUser) {

		} else {
			$retV = &$this->getDefaultAcl();
			return $retV;
		}

		$retV = new xyo_mod_ds_acl_Info;

		$retV->aclCore = $this->getAclSysCore();
		$retV->aclUserGroup = array();
		if($id_xyo_user) {
			$retV->aclUser = array(0, $id_xyo_user);
		} else {
			$retV->aclUser = 0;
		};
		$retV->aclUserId = $id_xyo_user;

		$listUserGroup = array();

		if ($id_xyo_user) {

			$dsUserXUserGroup = &$this->dsUserXUserGroup->copyThis();
			$dsUserXUserGroup->clear();
			$dsUserXUserGroup->id_xyo_user = $id_xyo_user;
			$dsUserXUserGroup->enabled = 1;

			for ($dsUserXUserGroup->load(); $dsUserXUserGroup->isValid(); $dsUserXUserGroup->loadNext()) {
				$listUserGroup[$dsUserXUserGroup->id_xyo_user_group]=$dsUserXUserGroup->id_xyo_user_group;
			};

		} else {
			$dsUserGroup = &$this->dsUserGroup->copyThis();
			$dsUserGroup->clear();
			$dsUserGroup->name = "public";
			$dsUserGroup->enabled = 1;

			if ($dsUserGroup->load(0, 1)) {
				$listUserGroup[$dsUserGroup->id]=$dsUserGroup->id;
			};
		}


		if (count($listUserGroup)) {
			$dsUserGroupXUserGroup = &$this->dsUserGroupXUserGroup->copyThis();
			$dsUserGroupXUserGroup->clear();
			$dsUserGroupXUserGroup->id_xyo_user_group_super = array_keys($listUserGroup);
			$dsUserGroupXUserGroup->enabled = 1;

			for ($dsUserGroupXUserGroup->load(); $dsUserGroupXUserGroup->isValid(); $dsUserGroupXUserGroup->loadNext()) {
				$listUserGroup[$dsUserGroupXUserGroup->id_xyo_user_group] = $dsUserGroupXUserGroup->id_xyo_user_group;
			}
		}

		$listUserGroup[0]=0;

		$retV->aclUserGroup=array_keys($listUserGroup);

		return $retV;
	}

	public function &getUserAcl($username) {
		if ($this->dsUser) {
			$dsUser = &$this->dsUser->copyThis();
			$dsUser->username = $username;
			$dsUser->enabled = 1;
			if ($dsUser->load(0, 1)) {
				$retV = &$this->getUserIdAcl($dsUser->id);
				return $retV;
			}
		}
		$retV = &$this->getDefaultAcl();
		return $retV;
	}

	public function setDsAcl(&$ds, &$acl) {
		$ds->id_xyo_core = $acl->aclCore;
		$ds->id_xyo_user_group = $acl->aclUserGroup;
	}

	public function setDsAclSys(&$ds) {
		$this->setDsAcl($ds, $this->acl);
	}

	public function setAclSys(&$acl) {
		$this->acl = &$acl;
	}

	public function &getAclSys() {
		return $this->acl;
	}

	public function setAclSysUserId($id_xyo_user) {
		$retV = $this->getUserIdAcl($id_xyo_user);		
		$this->setAclSys($retV);
	}

	public function setAclSysUser($username) {
		$retV = $this->getUserAcl($username);
		$this->setAclSys($retV);
	}


	public function processDsAcl(&$ds, &$acl) {
		$ds->enabled=1;
		$ds->id_xyo_core = $acl->aclCore;
		$ds->id_xyo_user_group = $acl->aclUserGroup;
		return $ds->load(0,1);
	}

	public function processDsAclList(&$ds, &$acl) {
		$ds->enabled=1;
		$ds->id_xyo_core = $acl->aclCore;
		$ds->id_xyo_user_group = $acl->aclUserGroup;
		return $ds->load();
	}

	public function processDsAclSys(&$ds) {
		return $this->processDsAcl($ds, $this->acl);
	}

	public function processDsAclSysList(&$ds) {
		return $this->processDsAclList($ds, $this->acl);
	}


}

