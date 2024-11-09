<?php

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class UUIDTest extends TestCase
{
    public function testGenerateUUID(): void
    {
        $uuid = Uuid::uuid4();
        $this->assertNotEmpty($uuid);
        $this->assertTrue(Uuid::isValid($uuid->toString()));
    }

    public function testUUIDUniqueness(): void
    {
        $uuid1 = Uuid::uuid4();
        $uuid2 = Uuid::uuid4();

        $this->assertNotEquals($uuid1->toString(), $uuid2->toString(), "UUID должны быть уникальными");
    }

    public function testUUIDEquality(): void
    {
        $uuid = Uuid::uuid4();
        $this->assertTrue($uuid->equals($uuid), "UUID должен быть равен сам себе");
    }
}
