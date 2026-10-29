<?php

declare(strict_types=1);

namespace EConnect\Psb\Test\Unit;

use EConnect\Psb\Model\Hook;
use EConnect\Psb\ObjectSerializer;
use PHPUnit\Framework\TestCase;

final class ObjectSerializerTest extends TestCase
{
    public function testSanitizeForSerializationFormatsImmutableDates(): void
    {
        $hook = (new Hook())
            ->setId('hook-1')
            ->setName('Default')
            ->setAction('https://example.test/hook')
            ->setCreatedOn(new \DateTimeImmutable('2026-01-02T03:04:05+00:00'));

        $serialized = ObjectSerializer::sanitizeForSerialization($hook);

        self::assertSame('2026-01-02T03:04:05+00:00', $serialized->createdOn);
    }

    public function testDateTimeValuesAreFormattedForQueryAndPath(): void
    {
        $date = new \DateTimeImmutable('2026-01-02T03:04:05+00:00');

        self::assertSame(['since' => '2026-01-02T03:04:05+00:00'], ObjectSerializer::toQueryValue($date, 'since', '\DateTime'));
        self::assertSame('2026-01-02T03%3A04%3A05%2B00%3A00', ObjectSerializer::toPathValue($date));
    }

    public function testDeserializeHydratesModelsFromJson(): void
    {
        $json = json_encode([[
            'id' => 'hook-1',
            'name' => 'Default',
            'action' => 'https://example.test/hook',
            'topics' => ['invoice-received'],
            'isActive' => true,
            'createdOn' => '2026-01-02T03:04:05.1234567+00:00',
        ]], JSON_THROW_ON_ERROR);

        /** @var Hook[] $hooks */
        $hooks = ObjectSerializer::deserialize($json, '\EConnect\Psb\Model\Hook[]');

        self::assertCount(1, $hooks);
        self::assertInstanceOf(Hook::class, $hooks[0]);
        self::assertSame('hook-1', $hooks[0]->getId());
        self::assertSame(['invoice-received'], $hooks[0]->getTopics());
        self::assertTrue($hooks[0]->getIsActive());
        self::assertSame('2026-01-02T03:04:05.123456+00:00', $hooks[0]->getCreatedOn()->format('Y-m-d\TH:i:s.uP'));
        self::assertTrue($hooks[0]->valid());
    }

    public function testModelRoundTripsThroughJson(): void
    {
        $hook = new Hook([
            'id' => 'hook-1',
            'name' => 'Default',
            'action' => 'https://example.test/hook',
            'is_active' => false,
            'created_on' => new \DateTime('2026-01-02T03:04:05+00:00'),
        ]);

        /** @var Hook $copy */
        $copy = ObjectSerializer::deserialize(json_encode($hook, JSON_THROW_ON_ERROR), Hook::class);

        self::assertSame($hook->getId(), $copy->getId());
        self::assertSame($hook->getName(), $copy->getName());
        self::assertSame($hook->getAction(), $copy->getAction());
        self::assertFalse($copy->getIsActive());
        self::assertEquals($hook->getCreatedOn(), $copy->getCreatedOn());
    }
}
