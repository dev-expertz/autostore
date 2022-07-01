<?php

namespace WebApi\DataTransferObjects;

use App\Helpers\ArrayExtended;
use App\Http\Responses\IJSONResponse;

class OidcDTO implements IJSONResponse
{
    public ?string $authorization_endpoint;
    public ?string $client_id;
    public ?string $redirect_uri;
    public ?string $response_type;
    public ?string $scope;

    public function __construct(
        ?string $authorization_endpoint,
        ?string $client_id,
        ?string $redirect_uri,
        ?string $response_type,
        ?string $scope     
    ) {
        $this->authorization_endpoint = $authorization_endpoint;
        $this->client_id = $client_id;
        $this->redirect_uri = $redirect_uri;
        $this->response_type = $response_type;
        $this->scope = $scope;
    }

    public static function getDefault(): self
    {
        return new self(
            config("app.url")."/api/v1/auth/login",
            "Drive2Driveway",
            config("app.url")."/api/v1/auth/login-callback",
            "code",
            "Drive2Driveway openid profile"
        );
    }

    public function toJSONResponse(): array
    {
        return ArrayExtended::filterNulls([
            'authorization_endpoint' => $this->authorization_endpoint,
            'client_id' => $this->client_id,
            'redirect_uri' => $this->redirect_uri,
            'response_type' => $this->response_type,
            'scope' => $this->scope
        ]);
    }
}