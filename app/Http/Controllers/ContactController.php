<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use App\Services\ContactService;
use App\Repositories\Interfaces\ContactRepositoryInterface;
use Facade\FlareClient\Http\Response;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\Log;
use PharIo\Manifest\Application;

class ContactController extends Controller
{
    /**
     * Instance of ContactService
     *
     * @var ContactService $contactService
     */
    protected ContactService $contactService;

    /**
     * Create a Contact controller instance.
     */
    public function __construct(ContactService $contactService)
    {
        $this->authorizeResource(Contact::class);

        $this->contactService = $contactService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ContactResource::collection(
            $this->contactService->all()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ContactRequest $request
     * @return ContactResource
     */
    public function store(ContactRequest $request): ContactResource|Application|Response|ResponseFactory
    {
        try {
            return new ContactResource($this->contactService->create(
                $request->validated()
            ));
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return \response(
                'Request Unsuccessful. New contact was not created.',
                400
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return ContactResource
     */
    public function show(int $id): ContactResource|Application|Response|ResponseFactory
    {
        try {
            return new ContactResource(
                $this->contactService->find($id)
            );
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return \response(
                'Request Unsuccessful. Unable to find response.',
                400
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ContactRequest $request
     * @param int $id
     *
     * @return ContactResource
     */
    public function update(ContactRequest  $request, int $id): ContactResource
    {
        return new ContactResource(
            $this->contactService->update($request->all(), $id)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        if($this->contactService->delete($id)) {
            return response()->json(null, 204);
        }

        return response()->json(null, 400);
    }
}
