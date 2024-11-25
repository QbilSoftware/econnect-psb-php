# EConnectPsb\PurchaseInvoiceApi

All URIs are relative to http://localhost, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**deletePurchaseInvoice()**](PurchaseInvoiceApi.md#deletePurchaseInvoice) | **DELETE** /api/v1/{partyId}/purchaseInvoice/{documentId} | Delete purchase invoice. |
| [**downloadPurchaseInvoice()**](PurchaseInvoiceApi.md#downloadPurchaseInvoice) | **GET** /api/v1/{partyId}/purchaseInvoice/{documentId}/download | Download purchase invoice. |
| [**getPurchaseInvoiceStatuses()**](PurchaseInvoiceApi.md#getPurchaseInvoiceStatuses) | **GET** /api/v1/{partyId}/purchaseInvoice/{documentId}/status | Get purchase invoice statuses. |
| [**queryRecipientPartyForInvoiceResponse()**](PurchaseInvoiceApi.md#queryRecipientPartyForInvoiceResponse) | **POST** /api/v1/{partyId}/purchaseInvoice/queryRecipientParty | Lookup the recipient party (seller/supplier) for possible delivery. |
| [**recognizePurchaseInvoice()**](PurchaseInvoiceApi.md#recognizePurchaseInvoice) | **POST** /api/v1/{partyId}/purchaseInvoice/recognize | Recognize purchase invoice. |
| [**sendInvoiceResponse()**](PurchaseInvoiceApi.md#sendInvoiceResponse) | **POST** /api/v1/{partyId}/purchaseInvoice/{documentId}/response | Send invoice response to let the seller know the status of the received invoice. |


## `deletePurchaseInvoice()`

```php
deletePurchaseInvoice($party_id, $document_id)
```

Delete purchase invoice.

Use this method if you don't want wait for the auto deletion.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Subscription-Key
$config = EConnectPsb\Configuration::getDefaultConfiguration()->setApiKey('Subscription-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = EConnectPsb\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Subscription-Key', 'Bearer');

// Configure OAuth2 access token for authorization: Bearer
$config = EConnectPsb\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new EConnectPsb\Api\PurchaseInvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$party_id = 'party_id_example'; // string | The recipient partyId
$document_id = 'document_id_example'; // string | The service bus documentId

try {
    $apiInstance->deletePurchaseInvoice($party_id, $document_id);
} catch (Exception $e) {
    echo 'Exception when calling PurchaseInvoiceApi->deletePurchaseInvoice: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **party_id** | **string**| The recipient partyId | |
| **document_id** | **string**| The service bus documentId | |

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

## `downloadPurchaseInvoice()`

```php
downloadPurchaseInvoice($party_id, $document_id, $target_format): \SplFileObject
```

Download purchase invoice.

Download the xml contents of the purchase invoice.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Subscription-Key
$config = EConnectPsb\Configuration::getDefaultConfiguration()->setApiKey('Subscription-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = EConnectPsb\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Subscription-Key', 'Bearer');

// Configure OAuth2 access token for authorization: Bearer
$config = EConnectPsb\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new EConnectPsb\Api\PurchaseInvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$party_id = 'party_id_example'; // string | The recipient partyId.
$document_id = 'document_id_example'; // string | The service bus documentId.
$target_format = 'target_format_example'; // string | The target format.

try {
    $result = $apiInstance->downloadPurchaseInvoice($party_id, $document_id, $target_format);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PurchaseInvoiceApi->downloadPurchaseInvoice: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **party_id** | **string**| The recipient partyId. | |
| **document_id** | **string**| The service bus documentId. | |
| **target_format** | **string**| The target format. | [optional] |

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

## `getPurchaseInvoiceStatuses()`

```php
getPurchaseInvoiceStatuses($party_id, $document_id): \EConnectPsb\Model\DocumentStatus[]
```

Get purchase invoice statuses.



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Subscription-Key
$config = EConnectPsb\Configuration::getDefaultConfiguration()->setApiKey('Subscription-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = EConnectPsb\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Subscription-Key', 'Bearer');

// Configure OAuth2 access token for authorization: Bearer
$config = EConnectPsb\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new EConnectPsb\Api\PurchaseInvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$party_id = 'party_id_example'; // string | The recipient partyId.
$document_id = 'document_id_example'; // string | The service bus documentId.

try {
    $result = $apiInstance->getPurchaseInvoiceStatuses($party_id, $document_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PurchaseInvoiceApi->getPurchaseInvoiceStatuses: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **party_id** | **string**| The recipient partyId. | |
| **document_id** | **string**| The service bus documentId. | |

### Return type

[**\EConnectPsb\Model\DocumentStatus[]**](../Model/DocumentStatus.md)

### Authorization

[Subscription-Key](../../README.md#Subscription-Key), [Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `queryRecipientPartyForInvoiceResponse()`

```php
queryRecipientPartyForInvoiceResponse($party_id, $request_body, $preferred_document_type_id): \EConnectPsb\Model\LookupParty
```

Lookup the recipient party (seller/supplier) for possible delivery.

The returned recipient partyId should be used as endpointId in the invoice response.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Subscription-Key
$config = EConnectPsb\Configuration::getDefaultConfiguration()->setApiKey('Subscription-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = EConnectPsb\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Subscription-Key', 'Bearer');

// Configure OAuth2 access token for authorization: Bearer
$config = EConnectPsb\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new EConnectPsb\Api\PurchaseInvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$party_id = 'party_id_example'; // string | The sender (buyer/customer) partyId.
$request_body = array('request_body_example'); // string[] | All possible partyIds of the recipient party.
$preferred_document_type_id = 'preferred_document_type_id_example'; // string | The source or preferred documentTypeId to match with and to determine the partyId format.

try {
    $result = $apiInstance->queryRecipientPartyForInvoiceResponse($party_id, $request_body, $preferred_document_type_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PurchaseInvoiceApi->queryRecipientPartyForInvoiceResponse: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **party_id** | **string**| The sender (buyer/customer) partyId. | |
| **request_body** | [**string[]**](../Model/string.md)| All possible partyIds of the recipient party. | |
| **preferred_document_type_id** | **string**| The source or preferred documentTypeId to match with and to determine the partyId format. | [optional] |

### Return type

[**\EConnectPsb\Model\LookupParty**](../Model/LookupParty.md)

### Authorization

[Subscription-Key](../../README.md#Subscription-Key), [Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `recognizePurchaseInvoice()`

```php
recognizePurchaseInvoice($party_id, $file, $channel): \EConnectPsb\Model\Document
```

Recognize purchase invoice.

Add file to purchase invoices queue for recognizing. The returned id is the documentId/traceId that will be used in status updates.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Subscription-Key
$config = EConnectPsb\Configuration::getDefaultConfiguration()->setApiKey('Subscription-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = EConnectPsb\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Subscription-Key', 'Bearer');

// Configure OAuth2 access token for authorization: Bearer
$config = EConnectPsb\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new EConnectPsb\Api\PurchaseInvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$party_id = 'party_id_example'; // string | The recipient partyId
$file = '/path/to/file.txt'; // \SplFileObject | The service bus documentId
$channel = 'channel_example'; // string | An optional parameter to enforce the use of a delivery channel.

try {
    $result = $apiInstance->recognizePurchaseInvoice($party_id, $file, $channel);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PurchaseInvoiceApi->recognizePurchaseInvoice: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **party_id** | **string**| The recipient partyId | |
| **file** | **\SplFileObject****\SplFileObject**| The service bus documentId | |
| **channel** | **string**| An optional parameter to enforce the use of a delivery channel. | [optional] |

### Return type

[**\EConnectPsb\Model\Document**](../Model/Document.md)

### Authorization

[Subscription-Key](../../README.md#Subscription-Key), [Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `sendInvoiceResponse()`

```php
sendInvoiceResponse($party_id, $document_id, $invoice_response): \EConnectPsb\Model\Document
```

Send invoice response to let the seller know the status of the received invoice.

Send invoice response message.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Subscription-Key
$config = EConnectPsb\Configuration::getDefaultConfiguration()->setApiKey('Subscription-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = EConnectPsb\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Subscription-Key', 'Bearer');

// Configure OAuth2 access token for authorization: Bearer
$config = EConnectPsb\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new EConnectPsb\Api\PurchaseInvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$party_id = 'party_id_example'; // string | Your partyId (buyer).
$document_id = 'document_id_example'; // string | DocumentId that the response is about.
$invoice_response = new \EConnectPsb\Model\InvoiceResponse(); // \EConnectPsb\Model\InvoiceResponse | Invoice response message.

try {
    $result = $apiInstance->sendInvoiceResponse($party_id, $document_id, $invoice_response);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PurchaseInvoiceApi->sendInvoiceResponse: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **party_id** | **string**| Your partyId (buyer). | |
| **document_id** | **string**| DocumentId that the response is about. | |
| **invoice_response** | [**\EConnectPsb\Model\InvoiceResponse**](../Model/InvoiceResponse.md)| Invoice response message. | |

### Return type

[**\EConnectPsb\Model\Document**](../Model/Document.md)

### Authorization

[Subscription-Key](../../README.md#Subscription-Key), [Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
