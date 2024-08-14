<?php

namespace App\Http\Controllers\Api;

use App\Models\Harvest;
use App\Models\Sale;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * For the purposes of this to demonstrate skill, I am implementing the routes in one controller, but they could be seperated out into multiple controllers.
 * Requests could use a Request Validation class to validate the incoming data.
 */
class EventFlowController extends ApiController
{
    /**
     * Harvest
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function harvested(Request $request): JsonResponse
    {
        $sale = Sale::create($request->all());

        return $this->standardResponse($sale->toArray());
    }

    /**
     * Sale
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function sale(Request $request): JsonResponse
    {
        $harvest = Harvest::create($request->all());

        return $this->standardResponse($harvest->toArray());
    }
}
