<?php

namespace App\Http\Controllers;

use App\Contracts\ContactRepositoryInterface;
use App\Http\Requests\contactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $contactRepository;

    public function __construct(ContactRepositoryInterface $contactRepository)
    {
            $this->contactRepository=$contactRepository;
    }
    public function index()
    {
        $contact=$this->contactRepository->getAll();

        // $contact=Contact::all();

        // $resource = ContactResource::collection($contact);
        // $con = ContactResource::collection($contact);
        return view('welcome',compact('contact'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(contactRequest $request)
    {
        $data=$request->validated();
            try{

                $contact=DB::transaction(function() use($data){
                    $contact=Contact::create($data);
                    return $contact;

                });
                if($contact!==null){
                    return back()->with('success','Contact send!');
                }

            }
            catch(\Exception $e){
                return back()->with('fail',$e->getMessage());

            }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
