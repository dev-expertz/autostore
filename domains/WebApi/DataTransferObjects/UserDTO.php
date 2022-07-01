<?php

namespace WebApi\DataTransferObjects;

use App\Helpers\ArrayExtended;
use App\Http\Responses\IJSONResponse;
use App\Models\User;

class UserDTO implements IJSONResponse
{
    public ?int $id;
    public ?string $name;
    public ?string $email;
    public ?string $password;
    public ?string $api_token;

    public function __construct(
        ?int $id,
        ?string $name,
        ?string $email,
        ?string $password,
        ?string $api_token = null     
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->api_token = $api_token;
    }

    public static function fromDBModel(User $model): self
    {
        return new self(
            $model->id,
            $model->name,
            $model->email,
            $model->password,
            isset($model->api_token) ? $model->api_token : null
        );
    }

    public function toJSONResponse($hide_password = false): array
    {
        return ArrayExtended::filterNulls([
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $hide_password ? null : $this->password,
            'api_token' => $this->api_token,
            'access_token' => $this->api_token
        ]);
    }
}