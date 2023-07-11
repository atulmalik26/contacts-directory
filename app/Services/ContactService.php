<?php

namespace App\Services;

use App\Repositories\Interfaces\ContactRepositoryInterface;
use App\Models\Contact;
use Illuminate\Pagination\LengthAwarePaginator;

class ContactService
{
    /**
     * Instance of ContactRepository
     *
     * @var ContactRepositoryInterface $contactRepository
     */
    protected ContactRepositoryInterface $contactRepository;

    /**
     * @param ContactRepositoryInterface $contactRepository
     */
    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * Return a listing of the resource
     *
     * @return LengthAwarePaginator
     */
    public function all(): LengthAwarePaginator
    {
        return $this->contactRepository->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  array  $data
     * @return Contact
     */
    public function create(array $data): Contact
    {
        return $this->contactRepository->create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Contact
     */
    public function find(int $id): Contact
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
    public function update(array $data, int $id): Contact
    {
        return $this->contactRepository->update($data, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return int
     */
    public function delete(int $id): int
    {
        return $this->contactRepository->delete($id);
    }
}
