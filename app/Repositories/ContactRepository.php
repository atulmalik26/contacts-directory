<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Repositories\Interfaces\ContactRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ContactRepository implements ContactRepositoryInterface
{
    /**
     * Return paginated contacts.
     *
     * @return LengthAwarePaginator
     */
    public function all(): LengthAwarePaginator
    {
        return Contact::paginate(10);
    }

    /**
     * Finds a contact by id.
     *
     * @param int $id
     * @return Contact
     */
    public function find(int $id): Contact
    {
        return Contact::findOrFail($id);
    }

    /**
     * Creates a new contact.
     *
     * @param array $data Contact data
     * @return Contact
     */
    public function create(array $data): Contact
    {
        return Contact::create($data);
    }

    /**
     * Updates a contact.
     *
     * @param array $data Contact data
     * @param int $id Contact id
     *
     * @return Contact
     */
    public function update(array $data, int $id): Contact
    {
        Contact::findOrFail($id)->update($data);

        return Contact::find($id);
    }

    /**
     * Deletes a contact.
     *
     * @param int $id Contact id
     * @return int
     */
    public function delete(int $id): int
    {
        return Contact::destroy($id);
    }
}