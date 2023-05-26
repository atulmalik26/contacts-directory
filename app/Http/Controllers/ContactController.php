<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Resources\ContactResource;
use App\Services\ContactService;
use App\Repositories\Interfaces\ContactRepositoryInterface;
use Facade\FlareClient\Http\Response;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ContactController extends Controller
{

    protected ContactService $contactService;

    public function __construct(ContactService $contactService)
    {
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
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request): ContactResource
    {
        return new ContactResource(
            $this->contactService->create($request->all())
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return ContactResource
     */
    public function show($id): ContactResource
    {
        return new ContactResource(
            $this->contactService->find($id)
        );
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
