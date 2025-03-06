# OpenAPIClient-php

PHP SDK for econnect PSB (https://psb.econnect.eu/?urls.primaryName=V1)


## Installation & Usage

### Requirements

PHP 8.2 and later.

### Composer

To install the bindings via [Composer](https://getcomposer.org/), add the following to `composer.json`:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/QbilSoftware/econnect-psb-php.git"
    }
  ],
  "require": {
    "QbilSoftware/econnect-psb-php": "@dev-main"
  }
}
```

Then run `composer install`

Your project is free to choose the http client of your choice
Please require packages that will provide http client functionality:
https://packagist.org/providers/psr/http-client-implementation
https://packagist.org/providers/php-http/async-client-implementation
https://packagist.org/providers/psr/http-factory-implementation

As an example:

```
composer require guzzlehttp/guzzle php-http/guzzle7-adapter http-interop/http-factory-guzzle
```

### Manual Installation

Download the files and include `autoload.php`:

```php
<?php
require_once('/path/to/OpenAPIClient-php/vendor/autoload.php');
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



// Configure API key authorization: Subscription-Key
$config = EConnect\Psb\Configuration::getDefaultConfiguration()->setApiKey('Subscription-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = EConnect\Psb\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Subscription-Key', 'Bearer');

$config
    ->setUsername("{username}")
    ->setPassword("{password}");
    ->setHost("https://psb.econnect.eu")
    ->setApiKey('Subscription-Key', '{subscription key}');
    
$authN = new \EConnect\Psb\Authentication($config);
$authN->login('{clientId}', '{clientSecret}');

$apiInstance = new EConnect\Psb\Api\HookApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getHookConfigs();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling HookApi->getHookConfigs: ', $e->getMessage(), PHP_EOL;
}

```

## API Endpoints

All URIs are relative to *http://localhost*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*HookApi* | [**getHookConfigs**](docs/Api/HookApi.md#gethookconfigs) | **GET** /api/v1/hook | Get registered environment hooks.
*HookApi* | [**getHooks**](docs/Api/HookApi.md#gethooks) | **GET** /api/v1/{partyId}/hook | Get registered hooks.
*HookApi* | [**removeHookConfig**](docs/Api/HookApi.md#removehookconfig) | **DELETE** /api/v1/hook/{hookId} | Delete default hook.
*HookApi* | [**sendHookPing**](docs/Api/HookApi.md#sendhookping) | **GET** /api/v1/{partyId}/hook/ping | Send ping to hook(s).
*HookApi* | [**setHookConfig**](docs/Api/HookApi.md#sethookconfig) | **PUT** /api/v1/hook | Add or update environment hook.
*HookApi* | [**subscribe**](docs/Api/HookApi.md#subscribe) | **PUT** /api/v1/{partyId}/hook | Add or update hook.
*HookApi* | [**unSubscribe**](docs/Api/HookApi.md#unsubscribe) | **DELETE** /api/v1/{partyId}/hook/{hookId} | Delete hook.
*MeApi* | [**getUser**](docs/Api/MeApi.md#getuser) | **GET** /api/v1/me | Get user.
*MeApi* | [**getUserParty**](docs/Api/MeApi.md#getuserparty) | **GET** /api/v1/me/party | Get parties.
*PeppolApi* | [**getDeliveryOptions**](docs/Api/PeppolApi.md#getdeliveryoptions) | **GET** /api/v1/peppol/deliveryOption | Advanced recipient party lookup in Peppol.
*PurchaseInvoiceApi* | [**deletePurchaseInvoice**](docs/Api/PurchaseInvoiceApi.md#deletepurchaseinvoice) | **DELETE** /api/v1/{partyId}/purchaseInvoice/{documentId} | Delete purchase invoice.
*PurchaseInvoiceApi* | [**downloadPurchaseInvoice**](docs/Api/PurchaseInvoiceApi.md#downloadpurchaseinvoice) | **GET** /api/v1/{partyId}/purchaseInvoice/{documentId}/download | Download purchase invoice.
*PurchaseInvoiceApi* | [**getPurchaseInvoiceStatuses**](docs/Api/PurchaseInvoiceApi.md#getpurchaseinvoicestatuses) | **GET** /api/v1/{partyId}/purchaseInvoice/{documentId}/status | Get purchase invoice statuses (FOR DEBUGGING ONLY).
*PurchaseInvoiceApi* | [**queryRecipientPartyForInvoiceResponse**](docs/Api/PurchaseInvoiceApi.md#queryrecipientpartyforinvoiceresponse) | **POST** /api/v1/{partyId}/purchaseInvoice/queryRecipientParty | Lookup the recipient party (seller/supplier) for possible delivery.
*PurchaseInvoiceApi* | [**recognizePurchaseInvoice**](docs/Api/PurchaseInvoiceApi.md#recognizepurchaseinvoice) | **POST** /api/v1/{partyId}/purchaseInvoice/recognize | Recognize purchase invoice.
*PurchaseInvoiceApi* | [**sendInvoiceResponse**](docs/Api/PurchaseInvoiceApi.md#sendinvoiceresponse) | **POST** /api/v1/{partyId}/purchaseInvoice/{documentId}/response | Send invoice response to let the seller know the status of the received invoice.
*PurchaseOrderApi* | [**apiV1PartyIdPurchaseOrderDocumentIdStatusGet**](docs/Api/PurchaseOrderApi.md#apiv1partyidpurchaseorderdocumentidstatusget) | **GET** /api/v1/{partyId}/purchaseOrder/{documentId}/status | Get purchase order statuses (FOR DEBUGGING ONLY).
*PurchaseOrderApi* | [**apiV1PartyIdPurchaseOrderQueryRecipientPartyPost**](docs/Api/PurchaseOrderApi.md#apiv1partyidpurchaseorderqueryrecipientpartypost) | **POST** /api/v1/{partyId}/purchaseOrder/queryRecipientParty | Lookup the recipient party (seller) for possible delivery.
*PurchaseOrderApi* | [**sendOrderCancellation**](docs/Api/PurchaseOrderApi.md#sendordercancellation) | **POST** /api/v1/{partyId}/purchaseOrder/{documentId}/cancel | Send order cancellation to let the seller know the order is cancelled.
*PurchaseOrderApi* | [**sendPurchaseOrder**](docs/Api/PurchaseOrderApi.md#sendpurchaseorder) | **POST** /api/v1/{partyId}/purchaseOrder/send | Send a purchase order.
*SalesInvoiceApi* | [**getSalesInvoiceStatuses**](docs/Api/SalesInvoiceApi.md#getsalesinvoicestatuses) | **GET** /api/v1/{partyId}/salesInvoice/{documentId}/status | Get sales invoice statuses (FOR DEBUGGING ONLY).
*SalesInvoiceApi* | [**queryRecipientPartyForSalesInvoice**](docs/Api/SalesInvoiceApi.md#queryrecipientpartyforsalesinvoice) | **POST** /api/v1/{partyId}/salesInvoice/queryRecipientParty | Lookup the recipient party (buyer/customer) for possible delivery.
*SalesInvoiceApi* | [**recognizeSalesInvoice**](docs/Api/SalesInvoiceApi.md#recognizesalesinvoice) | **POST** /api/v1/{partyId}/salesInvoice/recognize | Recognize sales invoice.
*SalesInvoiceApi* | [**sendSalesInvoice**](docs/Api/SalesInvoiceApi.md#sendsalesinvoice) | **POST** /api/v1/{partyId}/salesInvoice/send | Send an invoice.
*SalesOrderApi* | [**deleteSalesOrder**](docs/Api/SalesOrderApi.md#deletesalesorder) | **DELETE** /api/v1/{partyId}/salesOrder/{documentId} | Delete sales order.
*SalesOrderApi* | [**downloadSalesOrder**](docs/Api/SalesOrderApi.md#downloadsalesorder) | **GET** /api/v1/{partyId}/salesOrder/{documentId}/download | Download sales order.
*SalesOrderApi* | [**getSalesOrderStatuses**](docs/Api/SalesOrderApi.md#getsalesorderstatuses) | **GET** /api/v1/{partyId}/salesOrder/{documentId}/status | Get sales order statuses (FOR DEBUGGING ONLY).
*SalesOrderApi* | [**queryRecipientPartyForOrderResponse**](docs/Api/SalesOrderApi.md#queryrecipientpartyfororderresponse) | **POST** /api/v1/{partyId}/salesOrder/queryRecipientParty | Lookup the recipient party (buyer/customer) for possible delivery.
*SalesOrderApi* | [**sendOrderResponse**](docs/Api/SalesOrderApi.md#sendorderresponse) | **POST** /api/v1/{partyId}/salesOrder/{documentId}/response | Send order response to let the buyer know the status of the received order.
*UserApi* | [**addOrUpdateUser**](docs/Api/UserApi.md#addorupdateuser) | **PUT** /api/v1/user | Add or update users.
*UserApi* | [**addOrUpdateUserParty**](docs/Api/UserApi.md#addorupdateuserparty) | **PUT** /api/v1/user/{name}/party | Add or update user&#39;s party.
*UserApi* | [**deleteUser**](docs/Api/UserApi.md#deleteuser) | **DELETE** /api/v1/user/{name} | Delete user.
*UserApi* | [**deleteUserParty**](docs/Api/UserApi.md#deleteuserparty) | **DELETE** /api/v1/user/{name}/party/{partyId} | Removes user&#39;s party.
*UserApi* | [**getUserParties**](docs/Api/UserApi.md#getuserparties) | **GET** /api/v1/user/{name}/party | Get user&#39;s parties.
*UserApi* | [**getUsers**](docs/Api/UserApi.md#getusers) | **GET** /api/v1/user | List users.

## Models

- [DeliveryOption](docs/Model/DeliveryOption.md)
- [Document](docs/Model/Document.md)
- [DocumentFamily](docs/Model/DocumentFamily.md)
- [DocumentStatus](docs/Model/DocumentStatus.md)
- [Hook](docs/Model/Hook.md)
- [InvoiceResponse](docs/Model/InvoiceResponse.md)
- [InvoiceResponseActions](docs/Model/InvoiceResponseActions.md)
- [InvoiceResponseCodes](docs/Model/InvoiceResponseCodes.md)
- [InvoiceResponseReasons](docs/Model/InvoiceResponseReasons.md)
- [LookupParty](docs/Model/LookupParty.md)
- [OrderCancellation](docs/Model/OrderCancellation.md)
- [OrderDocumentFamily](docs/Model/OrderDocumentFamily.md)
- [OrderResponse](docs/Model/OrderResponse.md)
- [OrderResponseCodes](docs/Model/OrderResponseCodes.md)
- [Party](docs/Model/Party.md)
- [PartyPagedResult](docs/Model/PartyPagedResult.md)
- [PartyPermissions](docs/Model/PartyPermissions.md)
- [PeppolMigrateConfig](docs/Model/PeppolMigrateConfig.md)
- [PrepareToMigrateResponse](docs/Model/PrepareToMigrateResponse.md)
- [ProcessId](docs/Model/ProcessId.md)
- [TransportProtocol](docs/Model/TransportProtocol.md)
- [User](docs/Model/User.md)
- [UserParty](docs/Model/UserParty.md)

## Authorization

### Bearer

- **Type**: `OAuth`
- **Flow**: `implicit`
- **Authorization URL**: `https://identity.econnect.eu/connect/authorize`
- **Scopes**: 
    - **ap**: Procurement Service Bus API
    - **vpd**: Validated Party Service API


### Subscription-Key

- **Type**: API key
- **API key parameter name**: Subscription-Key
- **Location**: HTTP header


## Tests

To run the tests, use:

```bash
composer install
vendor/bin/phpunit
```

## Author

techsupport@econnect.eu

## About this package

This PHP package is automatically generated by the [OpenAPI Generator](https://openapi-generator.tech) project:

- API version: `1.0`
    - Generator version: `7.12.0`
- Build package: `org.openapitools.codegen.languages.PhpClientCodegen`
