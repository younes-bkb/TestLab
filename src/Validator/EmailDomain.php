<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
final class EmailDomain extends Constraint
{
    public string $message = 'Le domaine de l\'email "{{ domain }}" n\'est pas autorisé.';

    public function __construct(
        public array $blocked,
        ?array $groups = null,
        mixed $payload = null
    ) {
        parent::__construct([], $groups, $payload);
    }
}
