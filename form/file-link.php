<?php
//
// Copyright (c) 2014 Grigore Stefan, <g_stefan@yahoo.com>
// Created by Grigore Stefan <g_stefan@yahoo.com>
//
// The MIT License (MIT) <http://opensource.org/licenses/MIT>
//

defined('XYO_CLOUD') or die('Access is denied');

$element = $this->getArgument("element");
$collapse = $this->getArgument("collapse",false);

$collapseClass="collapse";
$collapseClassA="collapsed";
if($collapse==="in"){
	$collapseClass="collapse in";
	$collapseClassA="";
};


if($this->isAjax()){
	$this->ejsBegin();
	echo "\$(\"#".$this->getElementId($element)."\").fileinput({showUpload: false});";
	$this->ejsEnd();
}else{
	$this->setHtmlFooterJsSource("\$(function(){\$(\"#".$this->getElementId($element)."\").fileinput({showUpload: false});});");
};

$hasFile=false;
$fileName=$this->getElementValue($element);
if(strlen($fileName)){
	$hasFile=true;
};

if(!$collapse){
?>
<div class="form-group<?php if($this->isElementError($element)){echo " has-error";}; ?>">
    <label class="control-label" for="<?php $this->eElementId($element); ?>"><?php $this->eLanguage("label_" . $element); ?><?php if($this->isElementError($element)){echo " - "; $this->eElementError($element);}; ?></label>
	<table class="xyo-form-file-link-wrapper"><tbody>
	<tr>
	<td class="xyo-form-file-link-input" id="<?php $this->eElementId($element); ?>_info">
		<?php if($hasFile) { ?>
		<a href="<?php $this->site.$this->eElementValue($element); ?>" target="blank_"><?php echo $this->getFromLanguage("file_link_open"); ?></a>
		<?php }else{ ?>
		<span><?php echo $this->getFromLanguage("file_link_no_file"); ?></span>
		<?php }; ?>
	</td>
	<td class="xyo-form-file-link-delete">
		<span class="xyo-form-file-link-delete-sub" onclick="javascript:$('#<?php $this->eElementId($element); ?>_delete').val(1);$('#<?php $this->eElementId($element); ?>_info').html('<span><?php echo $this->getFromLanguage("file_link_no_file"); ?></span>');return false;"><i class="glyphicon glyphicon-remove"></i></span>
	</td>
	</tbody>
	</table>
    <input type="file" class="form-control"
       name="<?php $this->eElementName($element); ?>"
       value=""
       id="<?php $this->eElementId($element); ?>" ></input>
    <input type="hidden"
       name="<?php $this->eElementName($element); ?>_delete"
       value="0"
       id="<?php $this->eElementId($element); ?>_delete" ></input>
    <input type="hidden"
	name="<?php $this->eElementName($element); ?>_file"
       	value="<?php $this->eElementValue($element); ?>" ></input>
</div>
<?php } else { ?>
	<div class="panel panel-default pull-left" style="width: 32em;" id="<?php $this->eElementId($element); ?>_collapse_parent">
		<div class="panel-heading">
			<?php $this->eLanguage("label_" . $element); ?>                                                                                                              
			<a data-toggle="collapse" data-parent="#<?php $this->eElementId($element); ?>_collapse_parent" href="#<?php $this->eElementId($element); ?>_collapse" class="xyo-form-file-link-toggle <?php echo $collapseClassA; ?> pull-right">
				<i class="glyphicon glyphicon-chevron-left"></i>
				<i class="glyphicon glyphicon-chevron-down"></i>
			</a>
			<?php if($hasFile){ ?>                                                           
			<a href="<?php echo $this->getElementValue($element); ?>" target="blank_" class="xyo-form-file-link-link-on pull-right"><i class="glyphicon glyphicon-link"></i></a>
			<?php }else{ ?>
			<span class="xyo-form-file-link-link-off pull-right"><i class="glyphicon glyphicon-link"></i></span>
			<?php }; ?>
		</div>
		<div class="panel-body <?php echo $collapseClass ?>" id="<?php $this->eElementId($element); ?>_collapse">

<div class="form-group<?php if($this->isElementError($element)){echo " has-error";}; ?>">
    <?php if($this->isElementError($element)){echo $this->eElementError($element);}; ?>
	<table class="xyo-form-file-link-wrapper"><tbody>
	<tr>
	<td class="xyo-form-file-link-input" id="<?php $this->eElementId($element); ?>_info">
		<?php if($hasFile) { ?>
		<a href="<?php $this->site.$this->eElementValue($element); ?>" target="blank_"><?php echo $this->getFromLanguage("file_link_open"); ?></a>
		<?php }else{ ?>
		<span><?php echo $this->getFromLanguage("file_link_no_file"); ?></span>
		<?php }; ?>
	</td>
	<td class="xyo-form-file-link-delete">
		<span class="xyo-form-file-link-delete-sub" onclick="javascript:$('#<?php $this->eElementId($element); ?>_delete').val(1);$('#<?php $this->eElementId($element); ?>_info').html('<span><?php echo $this->getFromLanguage("file_link_no_file"); ?></span>');return false;"><i class="glyphicon glyphicon-remove"></i></span>
	</td>
	</tbody>
	</table>
	    <input type="file" class="form-control"
	       name="<?php $this->eElementName($element); ?>"
	       value=""
	       id="<?php $this->eElementId($element); ?>" ></input>
    <input type="hidden"
       name="<?php $this->eElementName($element); ?>_delete"
       value="0"
       id="<?php $this->eElementId($element); ?>_delete" ></input>
    <input type="hidden"
       name="<?php $this->eElementName($element); ?>_file"
       value="<?php $this->eElementValue($element); ?>" ></input>
</div>

		</div>
	</div>
<?php } ?>

