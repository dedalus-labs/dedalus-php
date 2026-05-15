<?php

namespace Tests\Services\Machines;

use Dedalus\Client;
use Dedalus\Core\Util;
use Dedalus\CursorPage;
use Dedalus\Machines\Terminals\Terminal;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class TerminalsTest extends TestCase
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
        $result = $this->client->machines->terminals->create(
            machineID: 'dm-3',
            height: 0,
            width: 0
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Terminal::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->machines->terminals->create(
            machineID: 'dm-3',
            height: 0,
            width: 0,
            cwd: 'cwd',
            env: ['foo' => 'string'],
            shell: 'shell',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Terminal::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->machines->terminals->retrieve(
            machineID: 'dm-3',
            terminalID: 'terminal_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Terminal::class, $result);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        $result = $this->client->machines->terminals->retrieve(
            machineID: 'dm-3',
            terminalID: 'terminal_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Terminal::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->machines->terminals->list(machineID: 'dm-3');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CursorPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Terminal::class, $item);
        }
    }

    #[Test]
    public function testListWithOptionalParams(): void
    {
        $page = $this->client->machines->terminals->list(
            machineID: 'dm-3',
            cursor: 'cursor',
            limit: 0
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CursorPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Terminal::class, $item);
        }
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->machines->terminals->delete(
            machineID: 'dm-3',
            terminalID: 'terminal_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Terminal::class, $result);
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        $result = $this->client->machines->terminals->delete(
            machineID: 'dm-3',
            terminalID: 'terminal_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Terminal::class, $result);
    }
}
