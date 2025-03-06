# EConnect\Psb\SalesOrderApi

All URIs are relative to http://localhost.

Method | HTTP request | Description
------------- | ------------- | -------------
[**deleteSalesOrder()**](SalesOrderApi.md#deleteSalesOrder) | **DELETE** /api/v1/{partyId}/salesOrder/{documentId} | Delete sales order.
[**downloadSalesOrder()**](SalesOrderApi.md#downloadSalesOrder) | **GET** /api/v1/{partyId}/salesOrder/{documentId}/download | Download sales order.
[**getSalesOrderStatuses()**](SalesOrderApi.md#getSalesOrderStatuses) | **GET** /api/v1/{partyId}/salesOrder/{documentId}/status | Get sales order statuses (FOR DEBUGGING ONLY).
[**queryRecipientPartyForOrderResponse()**](SalesOrderApi.md#queryRecipientPartyForOrderResponse) | **POST** /api/v1/{partyId}/salesOrder/queryRecipientParty | Lookup the recipient party (buyer/customer) for possible delivery.
[**sendOrderResponse()**](SalesOrderApi.md#sendOrderResponse) | **POST** /api/v1/{partyId}/salesOrder/{documentId}/response | Send order response to let the buyer know the status of the received order.


## `deleteSalesOrder()`

```php
deleteSalesOrder($party_id, $document_id)
```

Delete sales order.

Use this method if you don't want wait for the auto deletion.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Subscription-Key
$config = EConnect\Psb\Configuration::getDefaultConfiguration()->setApiKey('Subscription-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = EConnect\Psb\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Subscription-Key', 'Bearer');

// Configure OAuth2 access token for authorization: Bearer
$config = EConnect\Psb\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new EConnect\Psb\Api\SalesOrderApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$party_id = 'party_id_example'; // string | The recipient (seller) partyId
$document_id = 'document_id_example'; // string | The service bus documentId

try {
    $apiInstance->deleteSalesOrder($party_id, $document_id);
} catch (Exception $e) {
    echo 'Exception when calling SalesOrderApi->deleteSalesOrder: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **party_id** | **string**| The recipient (seller) partyId |
 **document_id** | **string**| The service bus documentId |

### Return type

void (empty response body)

### Authorization

[Subscription-Key](../../README.md#Subscription-Key), [Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `downloadSalesOrder()`

```php
downloadSalesOrder($party_id, $document_id, $target_format): \SplFileObject
```

Download sales order.

Download the xml contents of the sales order.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Subscription-Key
$config = EConnect\Psb\Configuration::getDefaultConfiguration()->setApiKey('Subscription-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = EConnect\Psb\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Subscription-Key', 'Bearer');

// Configure OAuth2 access token for authorization: Bearer
$config = EConnect\Psb\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new EConnect\Psb\Api\SalesOrderApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$party_id = 'party_id_example'; // string | The recipient (seller) partyId.
$document_id = 'document_id_example'; // string | The service bus documentId.
$target_format = 'target_format_example'; // string | The target format.

try {
    $result = $apiInstance->downloadSalesOrder($party_id, $document_id, $target_format);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SalesOrderApi->downloadSalesOrder: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **party_id** | **string**| The recipient (seller) partyId. |
 **document_id** | **string**| The service bus documentId. |
 **target_format** | **string**| The target format. | [optional]

### Return type

**\SplFileObject**

### Authorization

[Subscription-Key](../../README.md#Subscription-Key), [Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/xml`, `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getSalesOrderStatuses()`

```php
getSalesOrderStatuses($party_id, $document_id): \EConnect\Psb\Model\DocumentStatus[]
```

Get sales order statuses (FOR DEBUGGING ONLY).



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Subscription-Key
$config = EConnect\Psb\Configuration::getDefaultConfiguration()->setApiKey('Subscription-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = EConnect\Psb\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Subscription-Key', 'Bearer');

// Configure OAuth2 access token for authorization: Bearer
$config = EConnect\Psb\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new EConnect\Psb\Api\SalesOrderApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$party_id = 'party_id_example'; // string | The recipient (seller) partyId.
$document_id = 'document_id_example'; // string | The service bus documentId.

try {
    $result = $apiInstance->getSalesOrderStatuses($party_id, $document_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SalesOrderApi->getSalesOrderStatuses: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **party_id** | **string**| The recipient (seller) partyId. |
 **document_id** | **string**| The service bus documentId. |

### Return type

[**\EConnect\Psb\Model\DocumentStatus[]**](../Model/DocumentStatus.md)

### Authorization

[Subscription-Key](../../README.md#Subscription-Key), [Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `queryRecipientPartyForOrderResponse()`

```php
queryRecipientPartyForOrderResponse($party_id, $request_body, $preferred_document_type_id): \EConnect\Psb\Model\LookupParty
```

Lookup the recipient party (buyer/customer) for possible delivery.

The returned recipient partyId should be used as endpointId in the order response.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Subscription-Key
$config = EConnect\Psb\Configuration::getDefaultConfiguration()->setApiKey('Subscription-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = EConnect\Psb\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Subscription-Key', 'Bearer');

// Configure OAuth2 access token for authorization: Bearer
$config = EConnect\Psb\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new EConnect\Psb\Api\SalesOrderApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$party_id = 'party_id_example'; // string | The sender (seller/supplier) partyId.
$request_body = array('request_body_example'); // string[] | All possible partyIds of the recipient party.
$preferred_document_type_id = 'preferred_document_type_id_example'; // string | The source or preferred documentTypeId to match with and to determine the partyId format.

try {
    $result = $apiInstance->queryRecipientPartyForOrderResponse($party_id, $request_body, $preferred_document_type_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SalesOrderApi->queryRecipientPartyForOrderResponse: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **party_id** | **string**| The sender (seller/supplier) partyId. |
 **request_body** | [**string[]**](../Model/string.md)| All possible partyIds of the recipient party. |
 **preferred_document_type_id** | **string**| The source or preferred documentTypeId to match with and to determine the partyId format. | [optional]

### Return type

[**\EConnect\Psb\Model\LookupParty**](../Model/LookupParty.md)

### Authorization

[Subscription-Key](../../README.md#Subscription-Key), [Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `sendOrderResponse()`

```php
sendOrderResponse($party_id, $document_id, $order_response): \EConnect\Psb\Model\Document
```

Send order response to let the buyer know the status of the received order.

Send order response message.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Subscription-Key
$config = EConnect\Psb\Configuration::getDefaultConfiguration()->setApiKey('Subscription-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = EConnect\Psb\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Subscription-Key', 'Bearer');

// Configure OAuth2 access token for authorization: Bearer
$config = EConnect\Psb\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new EConnect\Psb\Api\SalesOrderApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$party_id = 'party_id_example'; // string | Your partyId (seller).
$document_id = 'document_id_example'; // string | DocumentId that the response is about.
$order_response = new \EConnect\Psb\Model\OrderResponse(); // \EConnect\Psb\Model\OrderResponse | Order response message.

try {
    $result = $apiInstance->sendOrderResponse($party_id, $document_id, $order_response);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SalesOrderApi->sendOrderResponse: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **party_id** | **string**| Your partyId (seller). |
 **document_id** | **string**| DocumentId that the response is about. |
 **order_response** | [**\EConnect\Psb\Model\OrderResponse**](../Model/OrderResponse.md)| Order response message. |

### Return type

[**\EConnect\Psb\Model\Document**](../Model/Document.md)

### Authorization

[Subscription-Key](../../README.md#Subscription-Key), [Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
