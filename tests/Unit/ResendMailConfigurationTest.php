<?php

use Illuminate\Mail\Transport\ResendTransport;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

uses(TestCase::class);

it('provides a resend mailer for the cloud email resource', function (): void {
    expect(config('mail.mailers.resend.transport'))->toBe('resend');
});

it('resolves the default mailer using the resend sdk', function (): void {
    config([
        'mail.default' => 'resend',
        'services.resend.key' => 're_configuration_test',
    ]);

    expect(Mail::mailer()->getSymfonyTransport())->toBeInstanceOf(ResendTransport::class);
});

it('loads the resend api key from the environment', function (): void {
    $environment = Env::getRepository();
    $originalKey = $environment->get('RESEND_API_KEY');
    $environment->set('RESEND_API_KEY', 're_configuration_test');

    try {
        $services = require base_path('config/services.php');

        expect($services['resend']['key'])->toBe('re_configuration_test');
    } finally {
        if ($originalKey === null) {
            $environment->clear('RESEND_API_KEY');
        } else {
            $environment->set('RESEND_API_KEY', $originalKey);
        }
    }
});
