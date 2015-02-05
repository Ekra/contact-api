<?php

class ContactsTest extends ApiTester {

    use Factory;
    /** @test */
    public function it_fetches_contacts()
    {
        //arrange
        $this->times(3)->make('contact');
        //act
        $this->getJson('api/v1/contacts');
        //assert
        $this->assertResponseOk();
    }
    /** @test */
    public function it_404s_if_a_contact_not_found()
    {
        $this->getJson('api/v1/contacts/x');
        $this->assertResponseStatus(404);
    }
    /** @test */
    public function it_fetches_a_single_contact()
    {
        $this->make('contact');
        $lesson = $this->getJson('api/v1/contacts/1')->data;
        $this->assertResponseOk();
        //$this->assertObjectHasAttributes($lesson,'body','active');
    }
    /** @test */
    public function it_creates_a_new_contact_given_valid_parameters()
    {
        $this->getJson('api/v1/contacts','POST', $this->getStub());
        $this->assertResponseStatus(201);
    }
    /** @test */
    public function it_throws_a_422_if_a_new_contact_request_fails_validation()
    {
        $this->getJson('api/v1/contacts','POST');
        $this->assertResponseStatus(422);
    }
    protected function getStub()
    {
        return [
            'first_name' => $this->fake->firstName(),
            'last_name' =>$this-> fake->lastName(),
            'email' => $this->fake->email(),
            'address' =>$this-> fake->address(),
            'twitter' =>$this-> fake-> word()
        ];
    }
}