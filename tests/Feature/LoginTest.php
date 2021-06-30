<?php

namespace Tests\Feature;

use App\Mail\MagicLoginLink;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_shows_error_if_email_not_found()
    {
        $this->post(route('login'), [
            'email' => 'doesntexist@email.com'
        ])->assertSessionHasErrors('email');
    }
    
    public function test_it_shows_success_when_email_exists()
    {
        $user = User::factory()->create();
        $this->post(route('login'), [
            'email' => $user->email,
        ])->assertSessionHas('success');
    }
    
    public function test_it_sends_an_email_on_success()
    {
        Mail::fake();
        $user = User::factory()->create();
        $this->post(route('login'), [
            'email' => $user->email,
        ])->assertSessionHas('success');
        Mail::assertQueued(MagicLoginLink::class);
    }
}
