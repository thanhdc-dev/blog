<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller
{
    protected $modelClass;
    protected $model;
    protected $validateClass;
    protected $validate;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if ($this->modelClass) {
            $this->model = new $this->modelClass;
        }
        if ($this->validateClass) {
            $this->validate = new $this->validateClass;
        }
    }

    /**
     * Get items
     *
     * @param Request $request
     * @return mixed
     */
    function index(Request $request) {
        $itemsPerPage = $request->query('itemsPerPage', 10);
        return $this->model::where('trash', false)
            ->where('delete', false)
            ->paginate($itemsPerPage)->toArray();
    }

    /**
     * Show item
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    function show($id): \Illuminate\Http\JsonResponse
    {
        $item = $this->model::where('id', $id)
            ->where('delete', false)
            ->where('trash', false)
            ->first();
        return response()->json(['status' => true, 'data' => $item]);
    }

    /**
     * Add item
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    function store(Request $request): \Illuminate\Http\JsonResponse
    {
        if (method_exists($this->validate,'storeValidate')) {
            $storeValidate = $this->validate->storeValidate();
            $validate = Validator::make($request->all(), $storeValidate['rules'], $storeValidate['messages']);
            if ($validate->fails()) {
                return response()->json(['status' => false, 'message' => $validate->errors()->first()]);
            }
        }

        $itemNew = $this->model->fill($request->post());
        $itemNew->save();

        return response()->json(['status' => true, 'data' => $itemNew]);
    }

    /**
     * Update item
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    function update($id, Request $request): \Illuminate\Http\JsonResponse
    {
        $item = $this->model::where('id', $id)
            ->where('delete', false)
            ->where('trash', false)
            ->first();

        if (!$item) {
            return response()->json(['status' => false, 'data' => null]);
        }
        $item->fill($request->post())->save();
        return response()->json(['status' => false, 'data' => $item]);
    }

    /**
     * Trash item
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    function trash(Request $request): \Illuminate\Http\JsonResponse
    {
        $ids = $request->post('ids', []);
        $itemsTrashed = $this->model::whereIn('id', $ids)
            ->where('delete', false)
            ->where('trash', false)
            ->update(['trash' => true]);

        return response()->json(['status' => (boolean)$itemsTrashed, 'data' => $itemsTrashed]);
    }

}
