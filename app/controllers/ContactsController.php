<?php
use Dingo\Api\Routing\ControllerTrait;
class ContactsController extends \BaseController {

    use ControllerTrait;

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{


         $contacts = Contact::all();
         return Response::json(array(
             'error' => false,
             'contacts' => $contacts->toArray()),
             200
         );






	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{


	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $contact = new Contact;
        $contact->first_name = Input::get('first_name');
        $contact->last_name = Input::get('last_name');
        $contact->email = Input::get('email');
        $contact->address = Input::get('address');
        $contact->twitter = Input::get('twitter');
        $contact->save();


        return Response::json(array(
            'errror' => false,
            'contacts' => $contact->toArray()
        ),200);


	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        //return "hapa";

        $contacts = Contact::where('id', $id)->get();

        return Response::json(array(
            'error' => false,
            'contacts' => $contacts->toArray()
        ), 200);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{



	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
       $contact = contact::find($id);

        {
            return $this->response->errorNotFound('Contact does not exist!.');
        }


        $contact->first_name = Input::get('first_name');
        $contact->last_name = Input::get('last_name');
        $contact->email = Input::get('email');
        $contact->address = Input::get('address');
        $contact->twitter = Input::get('twitter');
        $contact->save();

    }


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{


        $contact = contact::find($id);

        $contact->forceDelete();
        return $this->response->noContent();
	}

    public function restore($id)
    {

        $contact = contact::withTrashed()->find($id);
        $contact->restore($id);
        return $this->response->noContent();

    }

    public function archive($id)
    {
        $contact = contact::find($id);
        contact::destroy($id);
        return $this->response->noContent();
    }


}
