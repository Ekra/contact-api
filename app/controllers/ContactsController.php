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
             //'error' => false,
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

        $rules = [
            'first_name'     => 'required',
            'last_name'      => 'required',
            'email'          => 'required|email|unique:contacts',
            'address'        => 'required'
        ];

        $input = Input::all();
        $validator = Validator::make($input, $rules);
        if($validator->fails())
        {
            //throw new Dingo\Api\Exception\StoreResourceFailedException('Could not create new contact.', $validator->errors());
            return Response::json(array(
                // 'error' => false,
                'message' => 'validation failed'
            ),422);
        }

        $contact = Contact::newContact(Input::get('first_name'),Input::get('last_name'),
            Input::get('email'),Input::get('address'),Input::get('twitter'));

        $contact->save();


        return Response::json(array(
           // 'error' => false,
            'contacts' => 'contacts stored'
        ),201);


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

       // $contacts = Contact::where('id', $id)->get();
       $contacts = Contact::find($id);

        if( !$contacts ){
            return Response::json(array(
                //'error' => false,
                'message' => 'Single contact does not exist'
            ), 404);
        }else{
            return Response::json(array(
                //'error' => false,
                'contacts' => $contacts->toArray()
            ), 200);


        }
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

        if(!$contact) {
            return $this->response->errorNotFound('Contact does not exist!.');
        }


        $contact->first_name = Input::get('first_name');
        $contact->last_name = Input::get('last_name');
        $contact->email = Input::get('email');
        $contact->address = Input::get('address');
        $contact->twitter = Input::get('twitter');
        $contact->save();

        return Response::json(array(
            //'error' => false,
            'contacts' =>'contact updated'
        ), 200);

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
        //return $this->response->noContent();

        return Response::json(array(
            //'error' => false,
            'contacts' => 'contacts deleted'
        ), 200);
	}

    public function restore($id)
    {

        $contact = contact::withTrashed()->find($id);
        $contact->restore($id);
       // return $this->response->noContent();

        return Response::json(array(
            //'error' => false,
            'contacts' => 'contacts restored'
        ), 200);

    }

    public function archive($id)
    {
        $contact = contact::find($id);
        contact::destroy($id);
        //return $this->response->noContent();

        return Response::json(array(
            //'error' => false,
            'contacts' => 'contacts archived'
        ), 200);
    }


}
