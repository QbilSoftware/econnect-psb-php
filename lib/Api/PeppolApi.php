<?php

/**
 * PeppolApi
 * PHP version 7.2
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

namespace EConnect\Psb\Api;

use GuzzleHttp\Psr7\MultipartStream;
use Http\Client\Common\Plugin\ErrorPlugin;
use Http\Client\Common\Plugin\RedirectPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\Common\PluginClientFactory;
use Http\Client\Exception\HttpException;
use Http\Client\HttpAsyncClient;
use Http\Discovery\HttpAsyncClientDiscovery;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Http\Promise\Promise;
use EConnect\Psb\ApiException;
use EConnect\Psb\Configuration;
use EConnect\Psb\DebugPlugin;
use EConnect\Psb\HeaderSelector;
use EConnect\Psb\ObjectSerializer;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;

use function sprintf;

/**
 * PeppolApi Class Doc Comment
 *
 * @category Class
 * @package  EConnect\Psb
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class PeppolApi
{
    /**
     * @var PluginClient
     */
    protected $httpClient;

    /**
     * @var PluginClient
     */
    protected $httpAsyncClient;

    /**
     * @var UriFactoryInterface
     */
    protected $uriFactory;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /**
     * @var RequestFactoryInterface
     */
    protected $requestFactory;

    /**
     * @var StreamFactoryInterface
     */
    protected $streamFactory;

    public function __construct(
        ?ClientInterface $httpClient = null,
        ?Configuration $config = null,
        ?HttpAsyncClient $httpAsyncClient = null,
        ?UriFactoryInterface $uriFactory = null,
        ?RequestFactoryInterface $requestFactory = null,
        ?StreamFactoryInterface $streamFactory = null,
        ?HeaderSelector $selector = null,
        ?array $plugins = null,
        $hostIndex = 0
    ) {
        $this->config = $config ?? Configuration::getDefaultConfiguration();
        $this->requestFactory = $requestFactory ?? Psr17FactoryDiscovery::findRequestFactory();
        $this->streamFactory = $streamFactory ?? Psr17FactoryDiscovery::findStreamFactory();

        $plugins = $plugins ?? [
            new RedirectPlugin(['strict' => true]),
            new ErrorPlugin(),
        ];

        if ($this->config->getDebug()) {
            $plugins[] = new DebugPlugin(fopen($this->config->getDebugFile(), 'ab'));
        }

        $this->httpClient = (new PluginClientFactory())->createClient(
            $httpClient ?? Psr18ClientDiscovery::find(),
            $plugins
        );

        $this->httpAsyncClient = (new PluginClientFactory())->createClient(
            $httpAsyncClient ?? HttpAsyncClientDiscovery::find(),
            $plugins
        );

        $this->uriFactory = $uriFactory ?? Psr17FactoryDiscovery::findUriFactory();

        $this->headerSelector = $selector ?? new HeaderSelector();

        $this->hostIndex = $hostIndex;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex($hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation getDeliveryOptions
     *
     * Advanced recipient party lookup in Peppol.
     *
     * @param  string[] $party_ids All possible partyIds of the recipient party (required)
     * @param  string $preferred_document_type_id The source or preferred documentTypeId to match with and to determine the partyId format. (optional)
     * @param  string[] $document_type_ids Filter on document formats (optional)
     * @param  \EConnect\Psb\Model\DocumentFamily $document_family Document family (optional)
     * @param  bool $is_credit Example: Set it to true, to search only for CreditNotes or to false if you don&#39;t want to include CreditNotes in our result set. (optional)
     *
     * @throws \EConnect\Psb\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \EConnect\Psb\Model\DeliveryOption[]
     */
    public function getDeliveryOptions($party_ids, $preferred_document_type_id = null, $document_type_ids = null, $document_family = null, $is_credit = null)
    {
        list($response) = $this->getDeliveryOptionsWithHttpInfo($party_ids, $preferred_document_type_id, $document_type_ids, $document_family, $is_credit);
        return $response;
    }

    /**
     * Operation getDeliveryOptionsWithHttpInfo
     *
     * Advanced recipient party lookup in Peppol.
     *
     * @param  string[] $party_ids All possible partyIds of the recipient party (required)
     * @param  string $preferred_document_type_id The source or preferred documentTypeId to match with and to determine the partyId format. (optional)
     * @param  string[] $document_type_ids Filter on document formats (optional)
     * @param  \EConnect\Psb\Model\DocumentFamily $document_family Document family (optional)
     * @param  bool $is_credit Example: Set it to true, to search only for CreditNotes or to false if you don&#39;t want to include CreditNotes in our result set. (optional)
     *
     * @throws \EConnect\Psb\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array{0: \EConnect\Psb\Model\DeliveryOption[], 1: int, 2: string[]} array of \EConnect\Psb\Model\DeliveryOption[], HTTP status code, HTTP response headers (array of strings)
     */
    public function getDeliveryOptionsWithHttpInfo($party_ids, $preferred_document_type_id = null, $document_type_ids = null, $document_family = null, $is_credit = null)
    {
        $request = $this->getDeliveryOptionsRequest($party_ids, $preferred_document_type_id, $document_type_ids, $document_family, $is_credit);

        try {
            try {
                $response = $this->httpClient->sendRequest($request);
            } catch (HttpException $e) {
                $response = $e->getResponse();
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $response->getStatusCode(),
                        (string) $request->getUri()
                    ),
                    $request,
                    $response,
                    $e
                );
            } catch (ClientExceptionInterface $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $request,
                    null,
                    $e
                );
            }

            $statusCode = $response->getStatusCode();

            switch ($statusCode) {
                case 200:
                    if ('\EConnect\Psb\Model\DeliveryOption[]' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\EConnect\Psb\Model\DeliveryOption[]', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\EConnect\Psb\Model\DeliveryOption[]';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\EConnect\Psb\Model\DeliveryOption[]',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getDeliveryOptionsAsync
     *
     * Advanced recipient party lookup in Peppol.
     *
     * @param  string[] $party_ids All possible partyIds of the recipient party (required)
     * @param  string $preferred_document_type_id The source or preferred documentTypeId to match with and to determine the partyId format. (optional)
     * @param  string[] $document_type_ids Filter on document formats (optional)
     * @param  \EConnect\Psb\Model\DocumentFamily $document_family Document family (optional)
     * @param  bool $is_credit Example: Set it to true, to search only for CreditNotes or to false if you don&#39;t want to include CreditNotes in our result set. (optional)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function getDeliveryOptionsAsync($party_ids, $preferred_document_type_id = null, $document_type_ids = null, $document_family = null, $is_credit = null)
    {
        return $this->getDeliveryOptionsAsyncWithHttpInfo($party_ids, $preferred_document_type_id, $document_type_ids, $document_family, $is_credit)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getDeliveryOptionsAsyncWithHttpInfo
     *
     * Advanced recipient party lookup in Peppol.
     *
     * @param  string[] $party_ids All possible partyIds of the recipient party (required)
     * @param  string $preferred_document_type_id The source or preferred documentTypeId to match with and to determine the partyId format. (optional)
     * @param  string[] $document_type_ids Filter on document formats (optional)
     * @param  \EConnect\Psb\Model\DocumentFamily $document_family Document family (optional)
     * @param  bool $is_credit Example: Set it to true, to search only for CreditNotes or to false if you don&#39;t want to include CreditNotes in our result set. (optional)
     *
     * @throws \InvalidArgumentException
     * @return Promise
     */
    public function getDeliveryOptionsAsyncWithHttpInfo($party_ids, $preferred_document_type_id = null, $document_type_ids = null, $document_family = null, $is_credit = null)
    {
        $returnType = '\EConnect\Psb\Model\DeliveryOption[]';
        $request = $this->getDeliveryOptionsRequest($party_ids, $preferred_document_type_id, $document_type_ids, $document_family, $is_credit);

        return $this->httpAsyncClient->sendAsyncRequest($request)
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function (HttpException $exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $exception->getRequest(),
                        $exception->getResponse(),
                        $exception
                    );
                }
            );
    }

    /**
     * Create request for operation 'getDeliveryOptions'
     *
     * @param  string[] $party_ids All possible partyIds of the recipient party (required)
     * @param  string $preferred_document_type_id The source or preferred documentTypeId to match with and to determine the partyId format. (optional)
     * @param  string[] $document_type_ids Filter on document formats (optional)
     * @param  \EConnect\Psb\Model\DocumentFamily $document_family Document family (optional)
     * @param  bool $is_credit Example: Set it to true, to search only for CreditNotes or to false if you don&#39;t want to include CreditNotes in our result set. (optional)
     *
     * @throws \InvalidArgumentException
     * @return RequestInterface
     */
    public function getDeliveryOptionsRequest($party_ids, $preferred_document_type_id = null, $document_type_ids = null, $document_family = null, $is_credit = null)
    {
        // verify the required parameter 'party_ids' is set
        if ($party_ids === null || (is_array($party_ids) && count($party_ids) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $party_ids when calling getDeliveryOptions'
            );
        }
        if ($preferred_document_type_id !== null && !preg_match("/[A-Za-z0-9-:.]{1,}[#]{2}[A-Za-z0-9-:.#*]{1,}|^$/", $preferred_document_type_id)) {
            throw new \InvalidArgumentException("invalid value for \"preferred_document_type_id\" when calling PeppolApi.getDeliveryOptions, must conform to the pattern /[A-Za-z0-9-:.]{1,}[#]{2}[A-Za-z0-9-:.#*]{1,}|^$/.");
        }


        $resourcePath = '/api/v1/peppol/deliveryOption';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = null;
        $multipart = false;

        // query params
        if ($party_ids !== null) {
            if ('form' === 'form' && is_array($party_ids)) {
                foreach ($party_ids as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partyIds'] = $party_ids;
            }
        }
        // query params
        if ($preferred_document_type_id !== null) {
            if ('form' === 'form' && is_array($preferred_document_type_id)) {
                foreach ($preferred_document_type_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['preferredDocumentTypeId'] = $preferred_document_type_id;
            }
        }
        // query params
        if ($document_type_ids !== null) {
            if ('form' === 'form' && is_array($document_type_ids)) {
                foreach ($document_type_ids as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['documentTypeIds'] = $document_type_ids;
            }
        }
        // query params
        if ($document_family !== null) {
            if ('form' === 'form' && is_array($document_family)) {
                foreach ($document_family as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['documentFamily'] = $document_family;
            }
        }
        // query params
        if ($is_credit !== null) {
            if ('form' === 'form' && is_array($is_credit)) {
                foreach ($is_credit as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['isCredit'] = $is_credit;
            }
        }




        $headers = $this->headerSelector->selectHeaders(
            ['application/json'],
            '',
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

                // Manually set the `Content-Type` header
                $headers['Content-Type'] = "multipart/form-data; boundary={$httpBody->getBoundary()}";

            } elseif ($this->headerSelector->isJsonMime($headers['Content-Type'])) {
                $httpBody = json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('Subscription-Key');
        if ($apiKey !== null) {
            $headers['Subscription-Key'] = $apiKey;
        }
        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();

        $uri = $this->createUri($operationHost, $resourcePath, $queryParams);

        return $this->createRequest('GET', $uri, $headers, $httpBody);
    }


    /**
     * @param string $method
     * @param string|UriInterface $uri
     * @param array $headers
     * @param string|StreamInterface|null $body
     *
     * @return RequestInterface
     */
    protected function createRequest(string $method, $uri, array $headers = [], $body = null): RequestInterface
    {
        if (is_string($body) && '' !== $body && null === $this->streamFactory) {
            throw new \RuntimeException('Cannot create request: A stream factory is required to create a request with a non-empty string body.');
        }

        $request = $this->requestFactory->createRequest($method, $uri);

        foreach ($headers as $key => $value) {
            $request = $request->withHeader($key, $value);
        }

        if (null !== $body && '' !== $body) {
            $request = $request->withBody(
                is_string($body) ? $this->streamFactory->createStream($body) : $body
            );
        }

        return $request;
    }

    private function createUri(
        string $operationHost,
        string $resourcePath,
        array $queryParams
    ): UriInterface {
        $parsedUrl = parse_url($operationHost);

        $host = $parsedUrl['host'] ?? null;
        $scheme = $parsedUrl['scheme'] ?? null;
        $basePath = $parsedUrl['path'] ?? null;
        $port = $parsedUrl['port'] ?? null;
        $user = $parsedUrl['user'] ?? null;
        $password = $parsedUrl['pass'] ?? null;

        $uri = $this->uriFactory->createUri($basePath . $resourcePath)
            ->withHost($host)
            ->withScheme($scheme)
            ->withPort($port)
            ->withQuery(ObjectSerializer::buildQuery($queryParams));

        if ($user) {
            $uri = $uri->withUserInfo($user, $password);
        }

        return $uri;
    }
}
