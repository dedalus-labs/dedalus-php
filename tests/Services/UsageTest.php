<?php

namespace Tests\Services;

use Dedalus\Client;
use Dedalus\Core\Util;
use Dedalus\Usage\MachineComputeUsage;
use Dedalus\Usage\MachineStorageUsage;
use Dedalus\Usage\OrgUsage;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class UsageTest extends TestCase
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
    public function testRetrieve(): void
    {
        $result = $this->client->usage->retrieve();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(OrgUsage::class, $result);
    }

    #[Test]
    public function testMachineCompute(): void
    {
        $result = $this->client->usage->machineCompute();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MachineComputeUsage::class, $result);
    }

    #[Test]
    public function testMachineStorage(): void
    {
        $result = $this->client->usage->machineStorage();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MachineStorageUsage::class, $result);
    }
}
