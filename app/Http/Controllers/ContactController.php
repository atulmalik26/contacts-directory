<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use App\Services\ContactService;
use App\Repositories\Interfaces\ContactRepositoryInterface;
use Facade\FlareClient\Http\Response;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Log;

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
        //$this->authorizeResource(Contact::class);

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
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(ContactRequest $request)
    {
        try {
            return $this->contactService->create(
                $request->validated()
            );
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
     * @return ContactResource|Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try {
            return new ContactResource(
                $this->contactService->find($id)
            );
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return Response(
                'Request Unsuccessful. Unable to find response.',
                400
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return new ContactResource(
            $this->contactService->update($request->all(), $id)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->contactService->delete($id)) {
            return response()->json(null, 204);
        }
    }
}
