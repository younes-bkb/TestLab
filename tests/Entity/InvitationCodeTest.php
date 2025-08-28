<?php

namespace App\Tests\Entity;

use App\Entity\InvitationCode;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class InvitationCodeTest extends KernelTestCase
{

    public function getEntity(): InvitationCode
    {
        $invitationCode = new InvitationCode();
        $invitationCode->setCode("12345");
        $invitationCode->setDescription("Description");
        $invitationCode->setExpireAt(new \DateTimeImmutable());
        return $invitationCode;
    }

    public function testValidEntity()
    {
        $invitationCode = $this->getEntity();

        $validator = self::getContainer()->get('validator');
        $errors = $validator->validate($invitationCode);
        $this->assertCount(0, $errors);

    }

    public function testInvalidEntity()
    {
        $invitationCode = $this->getEntity();
        $invitationCode->setCode("1a345");

        $validator = self::getContainer()->get('validator');
        $errors = $validator->validate($invitationCode);
        $this->assertCount(1, $errors);
        
        $invitationCode->setCode("123456");
        $errors = $validator->validate($invitationCode);
        $this->assertCount(1, $errors);

    }

    public function testInvalidBlankCode()
    {
        $invitationCode = $this->getEntity();
        $invitationCode->setCode("");

        $validator = self::getContainer()->get('validator');
        $errors = $validator->validate($invitationCode);
        $this->assertCount(1, $errors);
    }
}