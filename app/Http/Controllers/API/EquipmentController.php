<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Equipment\StoreRequest;
use App\Http\Requests\Equipment\UpdateRequest;
use App\Http\Resources\EquipmentCollection;
use App\Http\Resources\EquipmentResource;
use App\Services\EquipmentService;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    protected $service;

    /**
     * @param EquipmentService $service
     */
    public function __construct(EquipmentService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return EquipmentCollection
     */
    public function index(Request $request)
    {
        $result = $this->service->getRecords($request, 5);
        return new EquipmentCollection($result);
    }

    /**
     * @param StoreRequest $request
     * @return EquipmentCollection
     */
    public function store(StoreRequest $request)
    {
        $result = $this->service->saveRecord($request);
        return (new EquipmentCollection($result));
    }

    /**
     * @param $id
     * @return EquipmentResource
     */
    public function show($id)
    {
        $result = $this->service->getRecord($id);
        return new EquipmentResource($result);
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return EquipmentResource
     */
    public function update(UpdateRequest $request, $id)
    {
        $result = $this->service->updateRecord($request, $id);
        return new EquipmentResource($result);
    }

    /**
     * @param $id
     * @return EquipmentResource
     */
    public function destroy($id)
    {
        $result = $this->service->deleteRecord($id);
        return new EquipmentResource($result);
    }
}
