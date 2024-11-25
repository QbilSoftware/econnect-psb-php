# EConnectPsb\PurchaseOrderApi

All URIs are relative to http://localhost, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiV1PartyIdPurchaseOrderDocumentIdStatusGet()**](PurchaseOrderApi.md#apiV1PartyIdPurchaseOrderDocumentIdStatusGet) | **GET** /api/v1/{partyId}/purchaseOrder/{documentId}/status | Get purchase order statuses. |
| [**apiV1PartyIdPurchaseOrderQueryRecipientPartyPost()**](PurchaseOrderApi.md#apiV1PartyIdPurchaseOrderQueryRecipientPartyPost) | **POST** /api/v1/{partyId}/purchaseOrder/queryRecipientParty | Lookup the recipient party (seller) for possible delivery. |
| [**sendOrderCancellation()**](PurchaseOrderApi.md#sendOrderCancellation) | **POST** /api/v1/{partyId}/purchaseOrder/{documentId}/cancel | Send order cancellation to let the seller know the order is cancelled. |
| [**sendPurchaseOrder()**](PurchaseOrderApi.md#sendPurchaseOrder) | **POST** /api/v1/{partyId}/purchaseOrder/send | Send a purchase order. |


## `apiV1PartyIdPurchaseOrderDocumentIdStatusGet()`

```php
apiV1PartyIdPurchaseOrderDocumentIdStatusGet($party_id, $document_id): \EConnectPsb\Model\DocumentStatus[]
```

Get purchase order statuses.

Get list of statuses of the purchase order.

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


$apiInstance = new EConnectPsb\Api\PurchaseOrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$party_id = 'party_id_example'; // string | The sender (buyer) partyId.
$document_id = 'document_id_example'; // string | The service bus documentId.

try {
    $result = $apiInstance->apiV1PartyIdPurchaseOrderDocumentIdStatusGet($party_id, $document_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PurchaseOrderApi->apiV1PartyIdPurchaseOrderDocumentIdStatusGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **party_id** | **string**| The sender (buyer) partyId. | |
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

## `apiV1PartyIdPurchaseOrderQueryRecipientPartyPost()`

```php
apiV1PartyIdPurchaseOrderQueryRecipientPartyPost($party_id, $request_body, $preferred_document_type_id, $document_family): \EConnectPsb\Model\LookupParty
```

Lookup the recipient party (seller) for possible delivery.

The returned recipient partyId should be used as endpointId in the purchase order, order change or order cancellation.

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


$apiInstance = new EConnectPsb\Api\PurchaseOrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$party_id = 'party_id_example'; // string | The sender (buyer) partyId.
$request_body = array('request_body_example'); // string[] | All possible partyIds of the recipient party.
$preferred_document_type_id = 'preferred_document_type_id_example'; // string | The source or preferred documentTypeId to match with and to determine the partyId format.
$document_family = new \EConnectPsb\Model\\EConnectPsb\Model\OrderDocumentFamily(); // \EConnectPsb\Model\OrderDocumentFamily | Document family

try {
    $result = $apiInstance->apiV1PartyIdPurchaseOrderQueryRecipientPartyPost($party_id, $request_body, $preferred_document_type_id, $document_family);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PurchaseOrderApi->apiV1PartyIdPurchaseOrderQueryRecipientPartyPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **party_id** | **string**| The sender (buyer) partyId. | |
| **request_body** | [**string[]**](../Model/string.md)| All possible partyIds of the recipient party. | |
| **preferred_document_type_id** | **string**| The source or preferred documentTypeId to match with and to determine the partyId format. | [optional] |
| **document_family** | [**\EConnectPsb\Model\OrderDocumentFamily**](../Model/.md)| Document family | [optional] |

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

## `sendOrderCancellation()`

```php
sendOrderCancellation($party_id, $document_id, $order_cancellation): \EConnectPsb\Model\Document
```

Send order cancellation to let the seller know the order is cancelled.

Send order cancellation message.

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


$apiInstance = new EConnectPsb\Api\PurchaseOrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$party_id = 'party_id_example'; // string | Your partyId (buyer).
$document_id = 'document_id_example'; // string | DocumentId that the cancellation is about.
$order_cancellation = new \EConnectPsb\Model\OrderCancellation(); // \EConnectPsb\Model\OrderCancellation | Order cancellation message.

try {
    $result = $apiInstance->sendOrderCancellation($party_id, $document_id, $order_cancellation);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PurchaseOrderApi->sendOrderCancellation: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **party_id** | **string**| Your partyId (buyer). | |
| **document_id** | **string**| DocumentId that the cancellation is about. | |
| **order_cancellation** | [**\EConnectPsb\Model\OrderCancellation**](../Model/OrderCancellation.md)| Order cancellation message. | |

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

## `sendPurchaseOrder()`

```php
sendPurchaseOrder($party_id, $file, $receiver_id, $channel): \EConnectPsb\Model\Document
```

Send a purchase order.

Add file to purchase order queue for sending. The returned id is the documentId/traceId that will be used as in status updates.

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


$apiInstance = new EConnectPsb\Api\PurchaseOrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$party_id = 'party_id_example'; // string | The sender (buyer) partyId.
$file = '/path/to/file.txt'; // \SplFileObject | Multipart file upload.
$receiver_id = 'receiver_id_example'; // string | An optional receiver partyId to enforce delivery to a specific endpoint. The receiverId will be injected into the document.
$channel = 'channel_example'; // string | An optional parameter to enforce the use of a delivery channel.

try {
    $result = $apiInstance->sendPurchaseOrder($party_id, $file, $receiver_id, $channel);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PurchaseOrderApi->sendPurchaseOrder: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **party_id** | **string**| The sender (buyer) partyId. | |
| **file** | **\SplFileObject****\SplFileObject**| Multipart file upload. | |
| **receiver_id** | **string**| An optional receiver partyId to enforce delivery to a specific endpoint. The receiverId will be injected into the document. | [optional] |
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
