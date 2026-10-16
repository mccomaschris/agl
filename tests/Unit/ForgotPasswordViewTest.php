<?php

use App\Models\Year;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Tests\TestCase;

uses(TestCase::class);

beforeEach(function (): void {
    view()->share('activeYear', new Year(['name' => '2026']));
    $this->withoutVite();
});

it('renders the password reset form with a login link', function (): void {
    $this->get(route('password.request'))
        ->assertOk()
        ->assertSee('Forgot password?')
        ->assertSee('Send reset link')
        ->assertSee('Back to login')
        ->assertSee('max-w-80')
        ->assertSee('name="email"', false)
        ->assertSee('name="_token"', false);
});

it('shows reset confirmation and email validation feedback', function (): void {
    $this->withSession([
        'status' => 'We have emailed your password reset link.',
        '_old_input' => ['email' => 'golfer@example.com'],
        'errors' => (new ViewErrorBag)->put('default', new MessageBag([
            'email' => 'Please enter a valid email address.',
        ])),
    ])->get(route('password.request'))
        ->assertOk()
        ->assertSee('We have emailed your password reset link.')
        ->assertSee('Please enter a valid email address.')
        ->assertSee('golfer@example.com');
});
