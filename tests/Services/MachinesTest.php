<?php

namespace Tests\Services;

use Dedalus\Client;
use Dedalus\Core\Util;
use Dedalus\CursorPage;
use Dedalus\Machines\Machine;
use Dedalus\Machines\MachineListItem;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class MachinesTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testCreate(): void
    {
        $result = $this->client->machines->create(
            memoryMiB: 0,
            storageGiB: 0,
            vcpu: 0
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Machine::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->machines->create(
            memoryMiB: 0,
            storageGiB: 0,
            vcpu: 0,
            autosleep: 'autosleep'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Machine::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->machines->retrieve(machineID: 'dm-3');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Machine::class, $result);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        $result = $this->client->machines->retrieve(machineID: 'dm-3');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Machine::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->machines->update(machineID: 'dm-3');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Machine::class, $result);
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        $result = $this->client->machines->update(
            machineID: 'dm-3',
            autosleep: 'autosleep',
            memoryMiB: 0,
            storageGiB: 0,
            vcpu: 0,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Machine::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->machines->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CursorPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(MachineListItem::class, $item);
        }
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->machines->delete(machineID: 'dm-3');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Machine::class, $result);
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        $result = $this->client->machines->delete(machineID: 'dm-3');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Machine::class, $result);
    }

    #[Test]
    public function testSleep(): void
    {
        $result = $this->client->machines->sleep(machineID: 'dm-3');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Machine::class, $result);
    }

    #[Test]
    public function testSleepWithOptionalParams(): void
    {
        $result = $this->client->machines->sleep(machineID: 'dm-3');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Machine::class, $result);
    }

    #[Test]
    public function testWake(): void
    {
        $result = $this->client->machines->wake(machineID: 'dm-3');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Machine::class, $result);
    }

    #[Test]
    public function testWakeWithOptionalParams(): void
    {
        $result = $this->client->machines->wake(machineID: 'dm-3');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Machine::class, $result);
    }
}
