<?php

namespace NeutrinoAPI;

/**
 * API response object for success or failure
 */
class APIResponse
{

    /**
     * @var array $data
     */
    private $data;

    /**
     * @var string $file
     */
    private $file;

    /**
     * @var int $statusCode
     */
    private $statusCode;

    /**
     * @var string $contentType
     */
    private $contentType;

    /**
     * @var int $errorCode
     */
    private $errorCode;

    /**
     * @var string $errorMessage
     */
    private $errorMessage;

    /**
     * @var string $errorCause
     */
    private $errorCause;

    /**
     * Constructor
     *
     * @param int $statusCode The HTTP response status code
     * @param string $contentType The HTTP response content type
     * @param array|null $data JSON data
     * @param string|null $file Path to downloaded temporary file
     * @param int|null $errorCode Unique Neutrino API error code
     * @param string|null $errorMessage A Neutrino API error message
     * @param string|null $errorCause A string representation of the exception
     */
    private function __construct(int $statusCode, string $contentType, ?array $data, ?string $file, ?int $errorCode, ?string $errorMessage, ?string $errorCause)
    {
        $this->statusCode = $statusCode;
        $this->contentType = $contentType;
        $this->data = $data;
        $this->file = $file;
        $this->errorCode = $errorCode;
        $this->errorMessage = $errorMessage;
        $this->errorCause = $errorCause;
    }

    /**
     * Is the response successul
     * 
     * @return boolean
     */
    function isOK(): bool
    {
        return isset($this->data) || isset($this->file);
    }

    /**
     * Response body
     * 
     * @return array|null
     */
    public function getData(): ?array
    {
        return $this->data;
    }

    /**
     * Local file path storing response body
     * 
     * @return string|null
     */
    public function getFile(): ?string
    {
        return $this->file;
    }

    /**
     * Response's HTTP status code
     * 
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Response body's media type
     * 
     * @return string
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }

    /**
     * Error code for request/response error
     * 
     * @return int|null
     */
    public function getErrorCode(): ?int
    {
        return $this->errorCode;
    }

    /**
     * Error message for request/response error
     * 
     * @return string|null
     */
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    /**
     * Cause of error e.g exception instance or stack trace
     * 
     * @return string|null
     */
    public function getErrorCause(): ?string
    {
        return $this->errorCause;
    }

    /**
     * Create API response for response data
     *
     * @param int $statusCode
     * @param string $contentType
     * @param array $data JSON data
     * @return APIResponse
     */
    static function ofData(int $statusCode, string $contentType, array $data): APIResponse
    {
        return new APIResponse($statusCode, $contentType, $data, null, null, null, null);
    }

    /**
     * Create API response for response file
     *
     * @param int $statusCode
     * @param string $contentType
     * @param string $outputFilePath Path to downloaded temporary file
     * @return APIResponse
     */
    static function ofOutputFilePath(int $statusCode, string $contentType, string $outputFilePath): APIResponse
    {
        return new APIResponse($statusCode, $contentType, null, $outputFilePath, null, null, null);
    }

    /**
     * Create API response for error code
     *
     * @param int $statusCode
     * @param string $contentType
     * @param int $errorCode error APIError error code
     * @return APIResponse
     */
    static function ofErrorCode(int $statusCode, string $contentType, int $errorCode): APIResponse
    {
        $errorMessage = APIErrorCode::getErrorMessage($errorCode);
        return new APIResponse($statusCode, $contentType, null, null, $errorCode, $errorMessage, null);
    }

    /**
     * Create API response for error cause
     *
     * @param int $errorCode error APIError error code
     * @param string $errorCause
     * @return APIResponse
     */
    static function ofErrorCause(int $errorCode, string $errorCause): APIResponse
    {
        $errorMessage = APIErrorCode::getErrorMessage($errorCode);
        return new APIResponse(0, "", null, null, $errorCode, $errorMessage, $errorCause);
    }

    /**
     * Create API response for HTTP status code
     *
     * @param int $statusCode
     * @param string $contentType
     * @param int $errorCode NeutrinoAPI response error code
     * @param string $errorMessage NeutrinoAPI response error message
     * @return APIResponse
     */
    static function ofHttpStatus(int $statusCode, string $contentType, int $errorCode, string $errorMessage): APIResponse
    {

        return new APIResponse($statusCode, $contentType, null, null, $errorCode, $errorMessage, null);
    }
}
