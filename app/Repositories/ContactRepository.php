<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Repositories\Interfaces\ContactRepositoryInterface;

class ContactRepository implements ContactRepositoryInterface
{
    public function all()
    {
        return Contact::all();
    }

    public function find(int $id)
    {
        return Contact::findOrFail($id);
    }

    public function create(array $data)
    {
        return Contact::create($data);
    }

    public function update(array $data, int $id)
    {
        Contact::findOrFail($id)->update($data);

        return Contact::find($id);
    }

    public function delete(int $id)
    {
        return Contact::destroy($id);
    }
}