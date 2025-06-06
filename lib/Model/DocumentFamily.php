<?php
/**
 * DocumentFamily
 *
 * PHP version 7.4
 *
 * @category Class
 * @package  EConnect\Psb
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
 * Generator version: 7.12.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace EConnect\Psb\Model;
use \EConnect\Psb\ObjectSerializer;

/**
 * DocumentFamily Class Doc Comment
 *
 * @category Class
 * @package  EConnect\Psb
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class DocumentFamily
{
    /**
     * Possible values of this enum
     */
    public const INVOICE = 'Invoice';

    public const INVOICE_RESPONSE = 'InvoiceResponse';

    public const REVIEW = 'Review';

    public const ORDER = 'Order';

    public const ORDER_RESPONSE = 'OrderResponse';

    public const ORDER_CHANGE = 'OrderChange';

    public const ORDER_CANCELLATION = 'OrderCancellation';

    public const TIME_CARD = 'TimeCard';

    public const MAINTENANCE_INSTRUCTION = 'MaintenanceInstruction';

    public const MAINTENANCE_STATUS = 'MaintenanceStatus';

    public const DESPATCH_ADVICE = 'DespatchAdvice';

    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::INVOICE,
            self::INVOICE_RESPONSE,
            self::REVIEW,
            self::ORDER,
            self::ORDER_RESPONSE,
            self::ORDER_CHANGE,
            self::ORDER_CANCELLATION,
            self::TIME_CARD,
            self::MAINTENANCE_INSTRUCTION,
            self::MAINTENANCE_STATUS,
            self::DESPATCH_ADVICE
        ];
    }
}


