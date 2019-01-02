<?php

class DataRequest
{
	public $Name = "";
	public $Where = "";
	public $IndexWhere = "";
	public $OrderBy = "";
	public $Ix = PHP_INT_MAX;
	public $NameRef = "";
	public $CodRef = PHP_INT_MAX;
	public $Limiter = array();
	public $NameRefs = array();
	public $FieldsRefs = array();
	public $LogicVals = array();
	public $Comparators = array();
	public $LogicNexts = array();
	public $Fields = array();

	function __construct () 
	{ }
}
