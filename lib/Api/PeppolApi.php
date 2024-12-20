<?php
/**
 * PeppolApi
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
 * Generator version: 7.10.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace EConnect\Psb\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use EConnect\Psb\ApiException;
use EConnect\Psb\Configuration;
use EConnect\Psb\HeaderSelector;
use EConnect\Psb\ObjectSerializer;

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
     * @var ClientInterface
     */
    protected $client;

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

    /** @var string[] $contentTypes **/
    public const contentTypes = [
        'getDeliveryOptions' => [
            'application/json',
        ],
    ];

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: Configuration::getDefaultConfiguration();
        $this->headerSelector = $selector ?: new HeaderSelector();
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getDeliveryOptions'] to see the possible values for this operation
     *
     * @throws \EConnect\Psb\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return |\EConnect\Psb\Model\DeliveryOption[]
     */
    public function getDeliveryOptions($party_ids, $preferred_document_type_id = null, $document_type_ids = null, $document_family = null, $is_credit = null, string $contentType = self::contentTypes['getDeliveryOptions'][0])
    {
        list($response) = $this->getDeliveryOptionsWithHttpInfo($party_ids, $preferred_document_type_id, $document_type_ids, $document_family, $is_credit, $contentType);
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getDeliveryOptions'] to see the possible values for this operation
     *
     * @throws \EConnect\Psb\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of |\EConnect\Psb\Model\DeliveryOption[], HTTP status code, HTTP response headers (array of strings)
     */
    public function getDeliveryOptionsWithHttpInfo($party_ids, $preferred_document_type_id = null, $document_type_ids = null, $document_family = null, $is_credit = null, string $contentType = self::contentTypes['getDeliveryOptions'][0])
    {
        $request = $this->getDeliveryOptionsRequest($party_ids, $preferred_document_type_id, $document_type_ids, $document_family, $is_credit, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 200:
                    if ('\EConnect\Psb\Model\DeliveryOption[]' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\EConnect\Psb\Model\DeliveryOption[]' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\EConnect\Psb\Model\DeliveryOption[]', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            $returnType = '\EConnect\Psb\Model\DeliveryOption[]';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getDeliveryOptions'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDeliveryOptionsAsync($party_ids, $preferred_document_type_id = null, $document_type_ids = null, $document_family = null, $is_credit = null, string $contentType = self::contentTypes['getDeliveryOptions'][0])
    {
        return $this->getDeliveryOptionsAsyncWithHttpInfo($party_ids, $preferred_document_type_id, $document_type_ids, $document_family, $is_credit, $contentType)
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getDeliveryOptions'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDeliveryOptionsAsyncWithHttpInfo($party_ids, $preferred_document_type_id = null, $document_type_ids = null, $document_family = null, $is_credit = null, string $contentType = self::contentTypes['getDeliveryOptions'][0])
    {
        $returnType = '\EConnect\Psb\Model\DeliveryOption[]';
        $request = $this->getDeliveryOptionsRequest($party_ids, $preferred_document_type_id, $document_type_ids, $document_family, $is_credit, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
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
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getDeliveryOptions'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getDeliveryOptionsRequest($party_ids, $preferred_document_type_id = null, $document_type_ids = null, $document_family = null, $is_credit = null, string $contentType = self::contentTypes['getDeliveryOptions'][0])
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
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $party_ids,
            'partyIds', // param base name
            'array', // openApiType
            'form', // style
            true, // explode
            true // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $preferred_document_type_id,
            'preferredDocumentTypeId', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $document_type_ids,
            'documentTypeIds', // param base name
            'array', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $document_family,
            'documentFamily', // param base name
            'DocumentFamily', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $is_credit,
            'isCredit', // param base name
            'boolean', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);




        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
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

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
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
        if (!empty($this->config->getAccessToken())) {
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
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
