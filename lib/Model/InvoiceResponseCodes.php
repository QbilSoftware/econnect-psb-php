<?php
/**
 * InvoiceResponseCodes
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
 * InvoiceResponseCodes Class Doc Comment
 *
 * @category Class
 * @description Status codes used as Invoice Response Codes    [AB] Acknowledge. Used when buyer has received a readable invoice message that can be understood and submitted for processing by the buyer.    [IP] In Process. Used when the processing of the Invoice has started in buyers system.    [UQ] Under query. Used when buyer will not proceed to accept the Invoice without receiving additional information from the seller.    [RE] Rejected. Used only when the buyer will not process the referenced Invoice any further. buyer is rejecting this invoice but not necessarily the commercial transaction.Although it can be used also for rejection for commercial reasons (invoice not corresponding to delivery).    [AP] Accepted. Used only when the buyer has given a final approval of the invoice and the next step is payment.    [PD] Fully Paid. Used only when the buyer has initiated the payment of the invoice.                Invoice response codes list:  ./misc/codeList.html#invoice-response-codes
 * @package  EConnect\Psb
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class InvoiceResponseCodes
{
    /**
     * Possible values of this enum
     */
    public const ACKNOWLEDGE = 'Acknowledge';

    public const IN_PROCESS = 'InProcess';

    public const UNDER_QUERY = 'UnderQuery';

    public const CONDITIONALLY_ACCEPTED = 'ConditionallyAccepted';

    public const REJECT = 'Reject';

    public const ACCEPT = 'Accept';

    public const PAID = 'Paid';

    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::ACKNOWLEDGE,
            self::IN_PROCESS,
            self::UNDER_QUERY,
            self::CONDITIONALLY_ACCEPTED,
            self::REJECT,
            self::ACCEPT,
            self::PAID
        ];
    }
}


