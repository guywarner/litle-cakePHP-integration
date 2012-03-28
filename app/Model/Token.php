<?php
App::uses('AppModel', 'Model');
/**
 * Auth Model
 *
 */
class Token extends AppModel {
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
	public $useTable = 'token';
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
}
