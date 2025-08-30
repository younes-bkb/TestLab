<?php

namespace App\Tests\Validator;

use App\Validator\EmailDomain;
use App\Validator\EmailDomainValidator;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Component\Validator\Exception\UnexpectedValueException;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class EmailDomainTest extends ConstraintValidatorTestCase
{
    protected function createValidator(): EmailDomainValidator
    {
        return new EmailDomainValidator();
    }

    public function testAllowedDomainIsValid(): void
    {
        $constraint = new EmailDomain(blocked: ['spam.com', 'fake.org']);
        $this->validator->validate('test@allowed.com', $constraint);

        $this->assertNoViolation();
    }

    #[DataProvider('getBlockedEmails')]
    public function testBlockedDomainRaisesViolation(string $email, string $blockedDomain): void
    {
        $constraint = new EmailDomain(blocked: ['spam.com', 'fake.org']);

        $this->validator->validate($email, $constraint);

        $this->buildViolation('Le domaine de l\'email "{{ domain }}" n\'est pas autorisé.')
            ->setParameter('{{ value }}', $email)
            ->setParameter('{{ domain }}', $blockedDomain)
            ->assertRaised();
    }

    public static function getBlockedEmails(): iterable
    {
        yield ['john.doe@spam.com', 'spam.com'];
        yield ['jane.doe@fake.org', 'fake.org'];
    }

    #[DataProvider('getValidNullOrEmptyValues')]
    public function testNullOrEmptyIsValid(?string $value): void
    {
        $constraint = new EmailDomain(blocked: ['blocked.com']);
        $this->validator->validate($value, $constraint);

        $this->assertNoViolation();
    }

    public static function getValidNullOrEmptyValues(): iterable
    {
        yield [null];
        yield [''];
    }

    public function testThrowsExceptionOnInvalidValueType(): void
    {
        $this->expectException(UnexpectedValueException::class);
        $constraint = new EmailDomain(blocked: ['blocked.com']);
        $this->validator->validate(new \stdClass(), $constraint);
    }
}
