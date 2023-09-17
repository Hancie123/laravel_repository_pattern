<?php

namespace App\Repositories;

use App\Contracts\ContactRepositoryInterface;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class ContactRepository implements ContactRepositoryInterface
{
    public function getAll()
    {
        return Contact::withTrashed()->get();
    }

    public function findById($id){
        return Contact::find($id);
    }

    public function delete($id)
    {

        try {
            $contact = DB::transaction(function () use ($id) {
                $contact = Contact::find($id);
                $contact->delete();

            });
        } catch (\Exception $e) {
            return back()->with('fail', $e->getMessage());
        }
    }
}
