<?php
/**
 * EventFixture
 *
 */
class EventFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'date' => array('type' => 'date', 'null' => false, 'default' => null),
		'max_sellers' => array('type' => 'integer', 'null' => false, 'default' => null),
		'max_items_per_seller' => array('type' => 'integer', 'null' => false, 'default' => null),
		'start_time' => array('type' => 'time', 'null' => true, 'default' => null),
		'end_time' => array('type' => 'time', 'null' => true, 'default' => null),
		'reservation_start' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'reservation_end' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_bin', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'created' => '2013-10-15 23:09:17',
			'modified' => '2013-10-15 23:09:17',
			'name' => 'Lorem ipsum dolor sit amet',
			'date' => '2013-10-15',
			'max_sellers' => 1,
			'max_items_per_seller' => 1,
			'start_time' => '23:09:17',
			'end_time' => '23:09:17',
			'reservation_start' => '2013-10-15 23:09:17',
			'reservation_end' => '2013-10-15 23:09:17'
		),
	);

}
