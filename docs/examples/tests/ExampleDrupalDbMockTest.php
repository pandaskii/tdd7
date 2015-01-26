<?php
/**
 * @file
 * @author Edward Murrell <edward@catalyst-au.net>
 * Simple test case to demo use of DatabaseConnection_unittest.
 *
 * Runs this test by running the following from the command line:
 *  phpunit sites/all/modules/contrib/tdd7/docs/examples/tests/ExampleDrupalDbMockTest.php
 */

/**
 * Sets the namespace for all code in this file. Note that this matches the
 * namespace in ExampleDrupalDbMock.inc.
 */
namespace tdd7\example;

/**
 * Load the production code - search_by_last_name() - being tested.
 */
require_once __DIR__ . '/../ExampleDrupalDbMock.inc';
/**
 * Loads the BasicTestCase class. This is extended from the phpunit
 * PHPUnit_Framework_TestCase base class so we can use all the the phpunit
 * assertion methods. The BasicTestCase also bootstraps Drupal for us.
 */
require_once __DIR__ . '/../../../basefixtures/BasicTestCase.php';
/**
 * Load the Database Mock class DatabaseConnection_unittest. This class extends
 * the drupal DB class DatabaseConnection, so that it that the mock is API
 * compatible with any code that interacts directly with the database.
 */
require_once __DIR__ . '/../../../mocks/Database.inc';

/**
 * Import BasicTestCase & DatabaseConnection_unittest into the local namespace.
 * This is not required, but helps keep the test code cleaner.
 */
use oua\lms\testframework\BasicTestCase;
use oua\lms\testframework\mocks\DatabaseConnection_unittest;

class ExampleDrupalDbMockTest extends \oua\lms\testframework\BasicTestCase {
  private $db;

  public function setUp() {
    $this->db = DatabaseConnection_unittest::getInstance();

    $this->db->addTestData('students', array(
      'ID'        => 447744,
      'firstName' => 'Jerry',
      'lastName'  => 'Smith',
      'studentID' => 'FD99314',
    ));
  }

  public function tearDown() {
    $this->db->resetTestData();
  }

  public function testRetrieve() {
    $this->assertCount(1, search_by_last_name('smith'));
  }
}
