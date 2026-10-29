# eConnect PSB PHP SDK

PHP SDK for the eConnect Procurement Service Bus (PSB) API (https://psb.econnect.eu/?urls.primaryName=V1)


## Installation & Usage

### Requirements

- PHP 8.2 or later
- A [PSR-18](https://packagist.org/providers/psr/http-client-implementation) HTTP client with an [HTTPlug async](https://packagist.org/providers/php-http/async-client-implementation) implementation, such as Symfony HttpClient or Guzzle
- Compatible with Symfony 6.4, 7.x and 8.x (Symfony 8 itself requires PHP 8.4 or later)

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
    "qbil-software/econnect-psb-php": "dev-main"
  }
}
```

Then run `composer install`.

Your project is free to choose the HTTP client of your choice. In a Symfony application, use Symfony HttpClient:

```
composer require symfony/http-client guzzlehttp/promises
```

Or use Guzzle 7 with its HTTPlug adapter:

```
composer require guzzlehttp/guzzle php-http/guzzle7-adapter
```

### Manual Installation

Download the files and include `autoload.php`:

```php
<?php
require_once('/path/to/econnect-psb-php/vendor/autoload.php');
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$config = (new EConnect\Psb\Configuration())
    ->setHost('https://psb.econnect.eu')
    ->setUsername('{username}')
    ->setPassword('{password}')
    ->setApiKey('Subscription-Key', '{subscription key}');

$authenticator = new EConnect\Psb\OidcAuthenticator(
    Http\Discovery\Psr18ClientDiscovery::find(),
    Http\Discovery\Psr17FactoryDiscovery::findRequestFactory(),
    Http\Discovery\Psr17FactoryDiscovery::findStreamFactory(),
    new Symfony\Component\Clock\NativeClock(),
    $config,
);

// Fetches an access token and stores it in $config. The token is cached and renewed
// shortly before it expires, so it is cheap to call this before every batch of API calls.
$authenticator->authenticate('{clientId}', '{clientSecret}');

// The HTTP client is optional: when omitted, it is discovered with `Psr18ClientDiscovery`.
$apiInstance = new EConnect\Psb\Api\HookApi(null, $config);

try {
    $result = $apiInstance->getHookConfigs();
    print_r($result);
} catch (EConnect\Psb\ApiException $e) {
    echo 'Exception when calling HookApi->getHookConfigs: ', $e->getMessage(), PHP_EOL;
}
```

### Symfony

With `symfony/framework-bundle` and `symfony/http-client` installed, register the SDK as services, for example in `config/services.yaml`:

```yaml
services:
    EConnect\Psb\Configuration:
        calls:
            - setHost: ['%env(PSB_HOST)%']
            - setUsername: ['%env(PSB_USERNAME)%']
            - setPassword: ['%env(PSB_PASSWORD)%']
            - setApiKey: ['Subscription-Key', '%env(PSB_SUBSCRIPTION_KEY)%']

    EConnect\Psb\OidcAuthenticator:
        arguments:
            $httpClient: '@psr18.http_client'
            $requestFactory: '@psr18.http_client'
            $streamFactory: '@psr18.http_client'
            $clock: '@clock'
            $config: '@EConnect\Psb\Configuration'

    EConnect\Psb\Api\:
        resource: '%kernel.project_dir%/vendor/qbil-software/econnect-psb-php/lib/Api/'
        autowire: true
```

The API classes then use Symfony HttpClient for both synchronous and asynchronous requests. Inject `OidcAuthenticator` and the API classes you need into your own services, and call `authenticate()` before using the APIs.

## API Endpoints

All URIs are relative to the configured host, e.g. *https://psb.econnect.eu*

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
*PeppolApi* | [**getPeppolConfig**](lib/Api/PeppolApi.php) | **GET** /api/v1/peppol/config | Get default Peppol configuration
*PeppolApi* | [**getPeppolParties**](lib/Api/PeppolApi.php) | **GET** /api/v1/peppol/config/party | Get your Peppol participants
*PeppolApi* | [**getPeppolPartyConfig**](lib/Api/PeppolApi.php) | **GET** /api/v1/peppol/config/party/{partyId} | Get participant Peppol configuration
*PeppolApi* | [**removePeppolPartyConfig**](lib/Api/PeppolApi.php) | **DELETE** /api/v1/peppol/config/party/{partyId} | Un register (Remove) participant in Peppol
*PeppolApi* | [**requestPartyPrepareToMigrate**](lib/Api/PeppolApi.php) | **GET** /api/v1/peppol/{partyId}/prepareToMigrate | Generates a migration key and registers it with the SML to enable participant transfer between SMPs
*PeppolApi* | [**setPeppolConfig**](lib/Api/PeppolApi.php) | **PUT** /api/v1/peppol/config | Add or update default Peppol configuration
*PeppolApi* | [**setPeppolPartyConfig**](lib/Api/PeppolApi.php) | **PUT** /api/v1/peppol/config/party/{partyId} | Register or update participant in Peppol
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

- [BusinessCardProperty](lib/Model/BusinessCardProperty.php)
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
- [PeppolBusinessCard](lib/Model/PeppolBusinessCard.php)
- [PeppolCapability](lib/Model/PeppolCapability.php)
- [PeppolConfig](lib/Model/PeppolConfig.php)
- [PeppolMigrateConfig](docs/Model/PeppolMigrateConfig.md)
- [PeppolPartyConfig](lib/Model/PeppolPartyConfig.php)
- [PeppolPartyVerification](lib/Model/PeppolPartyVerification.php)
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
composer test
```

The `unit` test suite in `test/Unit` covers authentication, (de)serialization and request building, including a run on top of Symfony HttpClient. The `generated` suite in `test/Api` and `test/Model` contains the placeholders created by OpenAPI Generator.

## Regenerating the SDK

Hand-maintained files are listed in `.openapi-generator-ignore` and are kept when regenerating. The generated code also carries the following patches, which have to be re-applied after regenerating:

- `lib/Api/*.php`: `createRequest()` always builds the request through the PSR-17 factories, and multipart requests set `Content-Type: multipart/form-data; boundary=...` from the `MultipartStream`.
- `lib/ObjectSerializer.php`: dates are detected with `\DateTimeInterface`, so `\DateTimeImmutable` values are serialized as well.
- `lib/DebugPlugin.php`: failed requests are logged as `<METHOD path HTTP/version> code message`.

`lib/functions.php` provides `GuzzleHttp\Psr7\try_fopen()`, which the generated file uploads call but `guzzlehttp/psr7` 2.0 and later no longer ship.

## Author

techsupport@econnect.eu

## About this package

This PHP package is automatically generated by the [OpenAPI Generator](https://openapi-generator.tech) project:

- API version: `1.0`
    - Generator version: `7.12.0`
- Build package: `org.openapitools.codegen.languages.PhpClientCodegen`
