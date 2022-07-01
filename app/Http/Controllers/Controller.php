<?php

namespace App\Http\Controllers;

use App\Http\Responses\BaseResponseDTO;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param BaseResponseDTO $responseDTO
     * @return \Illuminate\Http\JsonResponse
     */
    public static function handleResponse(BaseResponseDTO $responseDTO)
    {
        $data = $responseDTO->toJSONResponse();
        if ($responseDTO->isError && !isset($data["error"])) {
            $data = ['error' => $data];
        }

        if (App::environment('local')) {
            /// helpful in debug to visualize better the json, when there is already sent output
            /*if (headers_sent()) {
                echo '<pre>'.json_encode($responseDTO->data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).'</pre>';
                exit();
            }*/
        }

        return response()->json($data, $responseDTO->statusCode, [], JSON_UNESCAPED_SLASHES);
    }
}
