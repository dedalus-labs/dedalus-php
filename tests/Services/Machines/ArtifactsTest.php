<?php

namespace Tests\Services\Machines;

use Dedalus\Client;
use Dedalus\Core\Util;
use Dedalus\CursorPage;
use Dedalus\Machines\Artifacts\Artifact;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class ArtifactsTest extends TestCase
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
        $result = $this->client->machines->artifacts->retrieve(
            machineID: 'dm-3',
            artifactID: 'artifact_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Artifact::class, $result);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        $result = $this->client->machines->artifacts->retrieve(
            machineID: 'dm-3',
            artifactID: 'artifact_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Artifact::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->machines->artifacts->list(machineID: 'dm-3');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CursorPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Artifact::class, $item);
        }
    }

    #[Test]
    public function testListWithOptionalParams(): void
    {
        $page = $this->client->machines->artifacts->list(
            machineID: 'dm-3',
            cursor: 'cursor',
            limit: 0
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CursorPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Artifact::class, $item);
        }
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->machines->artifacts->delete(
            machineID: 'dm-3',
            artifactID: 'artifact_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Artifact::class, $result);
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        $result = $this->client->machines->artifacts->delete(
            machineID: 'dm-3',
            artifactID: 'artifact_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Artifact::class, $result);
    }
}
