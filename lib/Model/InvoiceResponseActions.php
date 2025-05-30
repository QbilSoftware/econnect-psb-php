<?php
/**
 * InvoiceResponseActions
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

use \ArrayAccess;
use \EConnect\Psb\ObjectSerializer;

/**
 * InvoiceResponseActions Class Doc Comment
 *
 * @category Class
 * @description Expectations towards the seller    [NOA] No action required.    [PIN] Provide information. Missing information requested without re-issuing invoice.    [NIN] Issue new invoice. Request to re-issue a corrected invoice.    [CNF] Credit fully. Request to fully cancel the referenced invoice with a credit note.    [CNP] Credit partially. Request to issue partial credit note for corrections only.    [CNA] Credit the amount. Request to repay the amount paid on the invoice.     [OTH] Other. Requested action is not defined by code.                  Status Clarification Action list:  ./misc/codeList.html#status-clarification-action
 * @package  EConnect\Psb
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class InvoiceResponseActions implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'InvoiceResponse_actions';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'no_action_required' => 'string',
        'provide_information' => 'string',
        'issue_new_invoice' => 'string',
        'credit_fully' => 'string',
        'credit_partially' => 'string',
        'credit_the_amount' => 'string',
        'other' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'no_action_required' => null,
        'provide_information' => null,
        'issue_new_invoice' => null,
        'credit_fully' => null,
        'credit_partially' => null,
        'credit_the_amount' => null,
        'other' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'no_action_required' => false,
        'provide_information' => false,
        'issue_new_invoice' => false,
        'credit_fully' => false,
        'credit_partially' => false,
        'credit_the_amount' => false,
        'other' => false
    ];

    /**
      * If a nullable field gets set to null, insert it here
      *
      * @var boolean[]
      */
    protected array $openAPINullablesSetToNull = [];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of nullable properties
     *
     * @return array
     */
    protected static function openAPINullables(): array
    {
        return self::$openAPINullables;
    }

    /**
     * Array of nullable field names deliberately set to null
     *
     * @return boolean[]
     */
    private function getOpenAPINullablesSetToNull(): array
    {
        return $this->openAPINullablesSetToNull;
    }

    /**
     * Setter - Array of nullable field names deliberately set to null
     *
     * @param boolean[] $openAPINullablesSetToNull
     */
    private function setOpenAPINullablesSetToNull(array $openAPINullablesSetToNull): void
    {
        $this->openAPINullablesSetToNull = $openAPINullablesSetToNull;
    }

    /**
     * Checks if a property is nullable
     *
     * @param string $property
     * @return bool
     */
    public static function isNullable(string $property): bool
    {
        return self::openAPINullables()[$property] ?? false;
    }

    /**
     * Checks if a nullable property is set to null.
     *
     * @param string $property
     * @return bool
     */
    public function isNullableSetToNull(string $property): bool
    {
        return in_array($property, $this->getOpenAPINullablesSetToNull(), true);
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'no_action_required' => 'NoActionRequired',
        'provide_information' => 'ProvideInformation',
        'issue_new_invoice' => 'IssueNewInvoice',
        'credit_fully' => 'CreditFully',
        'credit_partially' => 'CreditPartially',
        'credit_the_amount' => 'CreditTheAmount',
        'other' => 'Other'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'no_action_required' => 'setNoActionRequired',
        'provide_information' => 'setProvideInformation',
        'issue_new_invoice' => 'setIssueNewInvoice',
        'credit_fully' => 'setCreditFully',
        'credit_partially' => 'setCreditPartially',
        'credit_the_amount' => 'setCreditTheAmount',
        'other' => 'setOther'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'no_action_required' => 'getNoActionRequired',
        'provide_information' => 'getProvideInformation',
        'issue_new_invoice' => 'getIssueNewInvoice',
        'credit_fully' => 'getCreditFully',
        'credit_partially' => 'getCreditPartially',
        'credit_the_amount' => 'getCreditTheAmount',
        'other' => 'getOther'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[]|null $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(?array $data = null)
    {
        $this->setIfExists('no_action_required', $data ?? [], null);
        $this->setIfExists('provide_information', $data ?? [], null);
        $this->setIfExists('issue_new_invoice', $data ?? [], null);
        $this->setIfExists('credit_fully', $data ?? [], null);
        $this->setIfExists('credit_partially', $data ?? [], null);
        $this->setIfExists('credit_the_amount', $data ?? [], null);
        $this->setIfExists('other', $data ?? [], null);
    }

    /**
    * Sets $this->container[$variableName] to the given data or to the given default Value; if $variableName
    * is nullable and its value is set to null in the $fields array, then mark it as "set to null" in the
    * $this->openAPINullablesSetToNull array
    *
    * @param string $variableName
    * @param array  $fields
    * @param mixed  $defaultValue
    */
    private function setIfExists(string $variableName, array $fields, $defaultValue): void
    {
        if (self::isNullable($variableName) && array_key_exists($variableName, $fields) && is_null($fields[$variableName])) {
            $this->openAPINullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets no_action_required
     *
     * @return string|null
     */
    public function getNoActionRequired()
    {
        return $this->container['no_action_required'];
    }

    /**
     * Sets no_action_required
     *
     * @param string|null $no_action_required no_action_required
     *
     * @return self
     */
    public function setNoActionRequired($no_action_required)
    {
        if (is_null($no_action_required)) {
            throw new \InvalidArgumentException('non-nullable no_action_required cannot be null');
        }
        $this->container['no_action_required'] = $no_action_required;

        return $this;
    }

    /**
     * Gets provide_information
     *
     * @return string|null
     */
    public function getProvideInformation()
    {
        return $this->container['provide_information'];
    }

    /**
     * Sets provide_information
     *
     * @param string|null $provide_information provide_information
     *
     * @return self
     */
    public function setProvideInformation($provide_information)
    {
        if (is_null($provide_information)) {
            throw new \InvalidArgumentException('non-nullable provide_information cannot be null');
        }
        $this->container['provide_information'] = $provide_information;

        return $this;
    }

    /**
     * Gets issue_new_invoice
     *
     * @return string|null
     */
    public function getIssueNewInvoice()
    {
        return $this->container['issue_new_invoice'];
    }

    /**
     * Sets issue_new_invoice
     *
     * @param string|null $issue_new_invoice issue_new_invoice
     *
     * @return self
     */
    public function setIssueNewInvoice($issue_new_invoice)
    {
        if (is_null($issue_new_invoice)) {
            throw new \InvalidArgumentException('non-nullable issue_new_invoice cannot be null');
        }
        $this->container['issue_new_invoice'] = $issue_new_invoice;

        return $this;
    }

    /**
     * Gets credit_fully
     *
     * @return string|null
     */
    public function getCreditFully()
    {
        return $this->container['credit_fully'];
    }

    /**
     * Sets credit_fully
     *
     * @param string|null $credit_fully credit_fully
     *
     * @return self
     */
    public function setCreditFully($credit_fully)
    {
        if (is_null($credit_fully)) {
            throw new \InvalidArgumentException('non-nullable credit_fully cannot be null');
        }
        $this->container['credit_fully'] = $credit_fully;

        return $this;
    }

    /**
     * Gets credit_partially
     *
     * @return string|null
     */
    public function getCreditPartially()
    {
        return $this->container['credit_partially'];
    }

    /**
     * Sets credit_partially
     *
     * @param string|null $credit_partially credit_partially
     *
     * @return self
     */
    public function setCreditPartially($credit_partially)
    {
        if (is_null($credit_partially)) {
            throw new \InvalidArgumentException('non-nullable credit_partially cannot be null');
        }
        $this->container['credit_partially'] = $credit_partially;

        return $this;
    }

    /**
     * Gets credit_the_amount
     *
     * @return string|null
     */
    public function getCreditTheAmount()
    {
        return $this->container['credit_the_amount'];
    }

    /**
     * Sets credit_the_amount
     *
     * @param string|null $credit_the_amount credit_the_amount
     *
     * @return self
     */
    public function setCreditTheAmount($credit_the_amount)
    {
        if (is_null($credit_the_amount)) {
            throw new \InvalidArgumentException('non-nullable credit_the_amount cannot be null');
        }
        $this->container['credit_the_amount'] = $credit_the_amount;

        return $this;
    }

    /**
     * Gets other
     *
     * @return string|null
     */
    public function getOther()
    {
        return $this->container['other'];
    }

    /**
     * Sets other
     *
     * @param string|null $other other
     *
     * @return self
     */
    public function setOther($other)
    {
        if (is_null($other)) {
            throw new \InvalidArgumentException('non-nullable other cannot be null');
        }
        $this->container['other'] = $other;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


