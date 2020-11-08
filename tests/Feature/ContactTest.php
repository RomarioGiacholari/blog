<?php

namespace Tests\Feature;

use App\Mail\ContactMe;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

/**
 * @coversNothing
 */
class ContactTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Mail::fake();
    }

    public function test_it_sends_a_contact_me_email()
    {
        $endpoint = route('contact.store');
        $request  = [
            'name'    => 'John Doe',
            'email'   => 'johnDoe@example.com',
            'subject' => 'Hello',
            'message' => 'World',
            'answer'  => 4,
            'privacy' => true
        ];

        $response = $this->json('POST', $endpoint, $request);

        $response->assertStatus(200);
        $response->assertJson(['isSuccess' => true]);

        Mail::assertSent(ContactMe::class, function ($mail) use ($request) {
            return $request['name'] === $mail->name;
        });
    }

    public function test_it_validates_a_contact_me_email_request()
    {
        $endpoint = route('contact.store');
        $request  = [
            'name'    => null,
            'email'   => null,
            'subject' => null,
            'message' => null,
            'answer'  => null,
            'privacy' => false
        ];

        $response = $this->json('POST', $endpoint, $request);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(array_keys($request));

        Mail::assertNotSent(ContactMe::class);
    }
}
