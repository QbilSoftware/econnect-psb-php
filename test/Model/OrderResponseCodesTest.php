<?php
/**
 * OrderResponseCodesTest
 *
 * PHP version 7.4
 *
 * @category Class
 * @package  EConnectPsb
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * PSB API 1.0
 *
 * No description provided (generated by Openapi Generator https://github.com/openapitools/openapi-generator)
 *
 * The version of the OpenAPI document: 1.0
 * Contact: techsupport@econnect.eu
 * Generated by: https://openapi-generator.tech
 * Generator version: 7.10.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Please update the test case below to test the model.
 */

namespace EConnectPsb\Test\Model;

use PHPUnit\Framework\TestCase;

/**
 * OrderResponseCodesTest Class Doc Comment
 *
 * @category    Class
 * @description Status codes used as Order Response Codes    [AB] Acknowledge. The Order has been received. The Order has not yet been processed. No lines should be sent. An additional Order Response Advanced should be sent after processing, to accept, reject or accept with changes.  [RE] Rejected. The Order is rejected. No lines should be sent.  [AP] Accepted. The Order is accepted without amendment. No lines should be sent.  [CA] Conditionally Accepted. The Order is accepted with amendment on line level. All lines must be sent.  Invoice response codes list:  ./misc/codeList.html#order-response-codes
 * @package     EConnectPsb
 * @author      OpenAPI Generator team
 * @link        https://openapi-generator.tech
 */
class OrderResponseCodesTest extends TestCase
{

    /**
     * Setup before running any test case
     */
    public static function setUpBeforeClass(): void
    {
    }

    /**
     * Setup before running each test case
     */
    public function setUp(): void
    {
    }

    /**
     * Clean up after running each test case
     */
    public function tearDown(): void
    {
    }

    /**
     * Clean up after running all test cases
     */
    public static function tearDownAfterClass(): void
    {
    }

    /**
     * Test "OrderResponseCodes"
     */
    public function testOrderResponseCodes()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }
}