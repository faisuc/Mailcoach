<?php

namespace App\Support\TransactionalMailConfiguration\Drivers;

use Illuminate\Contracts\Config\Repository;

class MailgunConfigurationDriver extends TransactionalMailConfigurationDriver
{
    public function name(): string
    {
        return 'mailgun';
    }

    public function validationRules(): array
    {
        return [
            'mailgun_domain' => 'required',
            'mailgun_secret' => 'required',
            'mailgun_endpoint' => 'required',
        ];
    }

    public function registerConfigValues(Repository $config, array $values)
    {
        $config->set('mail.mailers.mailcoach-transactional.transport', $this->name());
        $config->set('services.mailgun', [
            'domain' => $values['mailgun_domain'],
            'secret' => $values['mailgun_secret'],
            'endpoint' => $values['mailgun_endpoint'],
        ]);
        $config->set('mailcoach.mailgun_feedback', [
            'signing_secret' => $values['mailgun_signing_secret'],
        ]);
    }
}
