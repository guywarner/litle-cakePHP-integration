<?php
App::uses('AppModel', 'Model');
/**
 * Sale Model
 *
 */
class Sale extends AppModel {
/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'cake_db';
/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'sale';
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
}
