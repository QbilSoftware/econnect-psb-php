<?php
/**
 * PartyPermissions
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
 * Do not edit the class manually.
 */

namespace EConnectPsb\Model;

use \ArrayAccess;
use \EConnectPsb\ObjectSerializer;

/**
 * PartyPermissions Class Doc Comment
 *
 * @category Class
 * @package  EConnectPsb
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class PartyPermissions implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'PartyPermissions';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'can_send_document' => 'bool',
        'can_receive_document' => 'bool',
        'can_remove_document' => 'bool',
        'can_manage_hook' => 'bool',
        'can_change_document_status' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'can_send_document' => null,
        'can_receive_document' => null,
        'can_remove_document' => null,
        'can_manage_hook' => null,
        'can_change_document_status' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'can_send_document' => false,
        'can_receive_document' => false,
        'can_remove_document' => false,
        'can_manage_hook' => false,
        'can_change_document_status' => false
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
        'can_send_document' => 'canSendDocument',
        'can_receive_document' => 'canReceiveDocument',
        'can_remove_document' => 'canRemoveDocument',
        'can_manage_hook' => 'canManageHook',
        'can_change_document_status' => 'canChangeDocumentStatus'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'can_send_document' => 'setCanSendDocument',
        'can_receive_document' => 'setCanReceiveDocument',
        'can_remove_document' => 'setCanRemoveDocument',
        'can_manage_hook' => 'setCanManageHook',
        'can_change_document_status' => 'setCanChangeDocumentStatus'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'can_send_document' => 'getCanSendDocument',
        'can_receive_document' => 'getCanReceiveDocument',
        'can_remove_document' => 'getCanRemoveDocument',
        'can_manage_hook' => 'getCanManageHook',
        'can_change_document_status' => 'getCanChangeDocumentStatus'
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
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->setIfExists('can_send_document', $data ?? [], null);
        $this->setIfExists('can_receive_document', $data ?? [], null);
        $this->setIfExists('can_remove_document', $data ?? [], null);
        $this->setIfExists('can_manage_hook', $data ?? [], null);
        $this->setIfExists('can_change_document_status', $data ?? [], null);
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
     * Gets can_send_document
     *
     * @return bool|null
     */
    public function getCanSendDocument()
    {
        return $this->container['can_send_document'];
    }

    /**
     * Sets can_send_document
     *
     * @param bool|null $can_send_document can_send_document
     *
     * @return self
     */
    public function setCanSendDocument($can_send_document)
    {
        if (is_null($can_send_document)) {
            throw new \InvalidArgumentException('non-nullable can_send_document cannot be null');
        }
        $this->container['can_send_document'] = $can_send_document;

        return $this;
    }

    /**
     * Gets can_receive_document
     *
     * @return bool|null
     */
    public function getCanReceiveDocument()
    {
        return $this->container['can_receive_document'];
    }

    /**
     * Sets can_receive_document
     *
     * @param bool|null $can_receive_document can_receive_document
     *
     * @return self
     */
    public function setCanReceiveDocument($can_receive_document)
    {
        if (is_null($can_receive_document)) {
            throw new \InvalidArgumentException('non-nullable can_receive_document cannot be null');
        }
        $this->container['can_receive_document'] = $can_receive_document;

        return $this;
    }

    /**
     * Gets can_remove_document
     *
     * @return bool|null
     */
    public function getCanRemoveDocument()
    {
        return $this->container['can_remove_document'];
    }

    /**
     * Sets can_remove_document
     *
     * @param bool|null $can_remove_document can_remove_document
     *
     * @return self
     */
    public function setCanRemoveDocument($can_remove_document)
    {
        if (is_null($can_remove_document)) {
            throw new \InvalidArgumentException('non-nullable can_remove_document cannot be null');
        }
        $this->container['can_remove_document'] = $can_remove_document;

        return $this;
    }

    /**
     * Gets can_manage_hook
     *
     * @return bool|null
     */
    public function getCanManageHook()
    {
        return $this->container['can_manage_hook'];
    }

    /**
     * Sets can_manage_hook
     *
     * @param bool|null $can_manage_hook can_manage_hook
     *
     * @return self
     */
    public function setCanManageHook($can_manage_hook)
    {
        if (is_null($can_manage_hook)) {
            throw new \InvalidArgumentException('non-nullable can_manage_hook cannot be null');
        }
        $this->container['can_manage_hook'] = $can_manage_hook;

        return $this;
    }

    /**
     * Gets can_change_document_status
     *
     * @return bool|null
     */
    public function getCanChangeDocumentStatus()
    {
        return $this->container['can_change_document_status'];
    }

    /**
     * Sets can_change_document_status
     *
     * @param bool|null $can_change_document_status can_change_document_status
     *
     * @return self
     */
    public function setCanChangeDocumentStatus($can_change_document_status)
    {
        if (is_null($can_change_document_status)) {
            throw new \InvalidArgumentException('non-nullable can_change_document_status cannot be null');
        }
        $this->container['can_change_document_status'] = $can_change_document_status;

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

