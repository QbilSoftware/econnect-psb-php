# EConnect\Psb\SalesInvoiceApi

All URIs are relative to http://localhost.

Method | HTTP request | Description
------------- | ------------- | -------------
[**getSalesInvoiceStatuses()**](SalesInvoiceApi.md#getSalesInvoiceStatuses) | **GET** /api/v1/{partyId}/salesInvoice/{documentId}/status | Get sales invoice statuses (FOR DEBUGGING ONLY).
[**queryRecipientPartyForSalesInvoice()**](SalesInvoiceApi.md#queryRecipientPartyForSalesInvoice) | **POST** /api/v1/{partyId}/salesInvoice/queryRecipientParty | Lookup the recipient party (buyer/customer) for possible delivery.
[**recognizeSalesInvoice()**](SalesInvoiceApi.md#recognizeSalesInvoice) | **POST** /api/v1/{partyId}/salesInvoice/recognize | Recognize sales invoice.
[**sendSalesInvoice()**](SalesInvoiceApi.md#sendSalesInvoice) | **POST** /api/v1/{partyId}/salesInvoice/send | Send an invoice.


## `getSalesInvoiceStatuses()`

```php
getSalesInvoiceStatuses($party_id, $document_id): \EConnect\Psb\Model\DocumentStatus[]
```

Get sales invoice statuses (FOR DEBUGGING ONLY).

Get list of statuses of the sales invoice.

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


$apiInstance = new EConnect\Psb\Api\SalesInvoiceApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$party_id = 'party_id_example'; // string | The sender partyId.
$document_id = 'document_id_example'; // string | The service bus documentId.

try {
    $result = $apiInstance->getSalesInvoiceStatuses($party_id, $document_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SalesInvoiceApi->getSalesInvoiceStatuses: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **party_id** | **string**| The sender partyId. |
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

## `queryRecipientPartyForSalesInvoice()`

```php
queryRecipientPartyForSalesInvoice($party_id, $request_body, $preferred_document_type_id): \EConnect\Psb\Model\LookupParty
```

Lookup the recipient party (buyer/customer) for possible delivery.

The returned recipient partyId should be used as endpointId in the sales invoice.

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


$apiInstance = new EConnect\Psb\Api\SalesInvoiceApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$party_id = 'party_id_example'; // string | The sender (seller/supplier) partyId.
$request_body = array('request_body_example'); // string[] | All possible partyIds of the recipient party.
$preferred_document_type_id = 'preferred_document_type_id_example'; // string | The source or preferred documentTypeId to match with and to determine the partyId format.

try {
    $result = $apiInstance->queryRecipientPartyForSalesInvoice($party_id, $request_body, $preferred_document_type_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SalesInvoiceApi->queryRecipientPartyForSalesInvoice: ', $e->getMessage(), PHP_EOL;
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

## `recognizeSalesInvoice()`

```php
recognizeSalesInvoice($party_id, $file, $channel): \EConnect\Psb\Model\Document
```

Recognize sales invoice.

Add file to sales invoices queue for recognizing. The returned id is the documentId/traceId that will be used in status updates.

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


$apiInstance = new EConnect\Psb\Api\SalesInvoiceApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$party_id = 'party_id_example'; // string | The sender partyId
$file = '/path/to/file.txt'; // \SplFileObject | The service bus documentId
$channel = 'channel_example'; // string | An optional parameter to enforce the use of a delivery channel.

try {
    $result = $apiInstance->recognizeSalesInvoice($party_id, $file, $channel);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SalesInvoiceApi->recognizeSalesInvoice: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **party_id** | **string**| The sender partyId |
 **file** | **\SplFileObject****\SplFileObject**| The service bus documentId |
 **channel** | **string**| An optional parameter to enforce the use of a delivery channel. | [optional]

### Return type

[**\EConnect\Psb\Model\Document**](../Model/Document.md)

### Authorization

[Subscription-Key](../../README.md#Subscription-Key), [Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `sendSalesInvoice()`

```php
sendSalesInvoice($party_id, $file, $receiver_id, $channel): \EConnect\Psb\Model\Document
```

Send an invoice.

Add file to sales invoices queue for sending. The returned id is the documentId/traceId that will be used as in status updates.

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


$apiInstance = new EConnect\Psb\Api\SalesInvoiceApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$party_id = 'party_id_example'; // string | The sender partyId.
$file = '/path/to/file.txt'; // \SplFileObject | Multipart file upload.
$receiver_id = 'receiver_id_example'; // string | An optional receiver partyId to enforce delivery to a specific endpoint. The receiverId will be injected into the document.
$channel = 'channel_example'; // string | An optional parameter to enforce the use of a delivery channel.

try {
    $result = $apiInstance->sendSalesInvoice($party_id, $file, $receiver_id, $channel);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SalesInvoiceApi->sendSalesInvoice: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **party_id** | **string**| The sender partyId. |
 **file** | **\SplFileObject****\SplFileObject**| Multipart file upload. |
 **receiver_id** | **string**| An optional receiver partyId to enforce delivery to a specific endpoint. The receiverId will be injected into the document. | [optional]
 **channel** | **string**| An optional parameter to enforce the use of a delivery channel. | [optional]

### Return type

[**\EConnect\Psb\Model\Document**](../Model/Document.md)

### Authorization

[Subscription-Key](../../README.md#Subscription-Key), [Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
