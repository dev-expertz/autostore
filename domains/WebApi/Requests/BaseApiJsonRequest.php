<?php

declare(strict_types=1);

namespace WebApi\Requests;

use WebApi\Responses\WebApiError;

class BaseApiJsonRequest extends BaseApiRequest
{
    private ?array $_contentArr;

    public function __construct()
    {
        parent::__construct();

        $this->_contentArr = json_decode($this->getContent(), true);
        // $this->isJson() just check the header, which can be still valid body.
        if (! (json_last_error() === JSON_ERROR_NONE) or is_null($this->_contentArr)) {
            $errorDTO = WebApiError::create(WebApiError::REQUEST_JSON_BODY_ISSUE);
            $this->_throwErrorDTO($errorDTO);
        }
    }

    public function getContentArray(): array
    {
        return $this->_contentArr;
    }
}