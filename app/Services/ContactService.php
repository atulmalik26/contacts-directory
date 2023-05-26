<?php

namespace App\Services;

use App\Repositories\Interfaces\ContactRepositoryInterface;
use App\Models\Contact;

class ContactService
{

    protected ContactRepositoryInterface $contactRepository;

    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository; 
    }

    /**
     * Return a listing of the resource
     *
     * @return Contact
     */
    public function all()
    {
        return $this->contactRepository->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  array  $data
     * @return Contact
     */
    public function create(array $request)
    {
        return $this->contactRepository->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Contact
     */
    public function find(int $id)
    {
        return $this->contactRepository->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @param  int  $id
     * @return Contact
     */
    public function update(array $data, int $id)
    {
        return $this->contactRepository->update($data, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return bool
     */
    public function delete(int $id)
    {
        return $this->contactRepository->delete($id);
    }
}
