<?php
/**
 * Created by PhpStorm.
 * User: akirachix
 * Date: 1/30/15
 * Time: 9:52 AM
 */

namespace Acme\Transformers;


class ContactTransformer extends Transformer{


    public    function transform($contact)
    {

        {

            return[

                'id' => $contact['id'],
                'first_name' => $contact['first_name'],
                'last_name' => $contact['last_name'],
                'email' => $contact['email'],
                'address' => $contact['address'],
                'twitter' => $contact['twitter'],
                'created_at' => $contact['created_at'],
                 'last_updated_at' => $contact['last_updated_at'],
                ' archived_at' => $contact['deleted_at'],






            ];

        }



    }

}