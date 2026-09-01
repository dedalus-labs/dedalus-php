<?php

namespace Tests\Services\Machines;

use Dedalus\Client;
use Dedalus\Core\Util;
use Dedalus\CursorPage;
use Dedalus\Machines\Executions\Execution;
use Dedalus\Machines\Executions\ExecutionEvent;
use Dedalus\Machines\Executions\ExecutionOutput;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class ExecutionsTest extends TestCase
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
        $result = $this->client->machines->executions->create(
            machineID: 'dm-ecc2efdd-ddfa-31a9-c6f1-b833d337aa7c',
            command: ['string']
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Execution::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->machines->executions->create(
            machineID: 'dm-ecc2efdd-ddfa-31a9-c6f1-b833d337aa7c',
            command: ['string'],
            cwd: 'cwd',
            env: ['foo' => 'string'],
            stdin: 'stdin',
            timeoutMs: 0,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Execution::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->machines->executions->retrieve(
            machineID: 'dm-ecc2efdd-ddfa-31a9-c6f1-b833d337aa7c',
            executionID: 'execution_id',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Execution::class, $result);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        $result = $this->client->machines->executions->retrieve(
            machineID: 'dm-ecc2efdd-ddfa-31a9-c6f1-b833d337aa7c',
            executionID: 'execution_id',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Execution::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->machines->executions->list(
            machineID: 'dm-ecc2efdd-ddfa-31a9-c6f1-b833d337aa7c'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CursorPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Execution::class, $item);
        }
    }

    #[Test]
    public function testListWithOptionalParams(): void
    {
        $page = $this->client->machines->executions->list(
            machineID: 'dm-ecc2efdd-ddfa-31a9-c6f1-b833d337aa7c',
            cursor: 'cursor',
            limit: 0,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CursorPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Execution::class, $item);
        }
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->machines->executions->delete(
            machineID: 'dm-ecc2efdd-ddfa-31a9-c6f1-b833d337aa7c',
            executionID: 'execution_id',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Execution::class, $result);
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        $result = $this->client->machines->executions->delete(
            machineID: 'dm-ecc2efdd-ddfa-31a9-c6f1-b833d337aa7c',
            executionID: 'execution_id',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Execution::class, $result);
    }

    #[Test]
    public function testEvents(): void
    {
        $page = $this->client->machines->executions->events(
            machineID: 'dm-ecc2efdd-ddfa-31a9-c6f1-b833d337aa7c',
            executionID: 'execution_id',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CursorPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(ExecutionEvent::class, $item);
        }
    }

    #[Test]
    public function testEventsWithOptionalParams(): void
    {
        $page = $this->client->machines->executions->events(
            machineID: 'dm-ecc2efdd-ddfa-31a9-c6f1-b833d337aa7c',
            executionID: 'execution_id',
            cursor: 'cursor',
            limit: 0,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CursorPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(ExecutionEvent::class, $item);
        }
    }

    #[Test]
    public function testOutput(): void
    {
        $result = $this->client->machines->executions->output(
            machineID: 'dm-ecc2efdd-ddfa-31a9-c6f1-b833d337aa7c',
            executionID: 'execution_id',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ExecutionOutput::class, $result);
    }

    #[Test]
    public function testOutputWithOptionalParams(): void
    {
        $result = $this->client->machines->executions->output(
            machineID: 'dm-ecc2efdd-ddfa-31a9-c6f1-b833d337aa7c',
            executionID: 'execution_id',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ExecutionOutput::class, $result);
    }
}
