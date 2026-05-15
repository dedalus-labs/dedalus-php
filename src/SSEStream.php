<?php

namespace Dedalus;

use Dedalus\Core\Concerns\SdkStream;
use Dedalus\Core\Contracts\BaseStream;
use Dedalus\Core\Conversion;
use Dedalus\Core\Exceptions\APIStatusException;
use Dedalus\Core\Util;

/**
 * @template TItem
 *
 * @implements BaseStream<TItem>
 */
final class SSEStream implements BaseStream
{
    /**
     * @use SdkStream<array{
     *   event?: string|null, data?: string|null, id?: string|null, retry?: int|null
     * },
     * TItem,>
     */
    use SdkStream;

    private function parsedGenerator(): \Generator
    {
        if (!$this->stream->valid()) {
            return;
        }

        foreach ($this->stream as $row) {
            switch ($row['event'] ?? null) {
                case 'bookmark': break;

                case 'error':
                    if ($data = $row['data'] ?? '') {
                        $json = Util::decodeJson($data);
                        $message = Util::prettyEncodeJson($json);

                        $exn = APIStatusException::from(
                            request: $this->request,
                            response: $this->response,
                            message: $message,
                        );

                        throw $exn;
                    }

                    break;

                case 'status':
                    if ($data = $row['data'] ?? '') {
                        $decoded = Util::decodeJson($data);

                        yield Conversion::coerce($this->convert, value: $decoded);
                    }

                    break;
            }
        }
    }
}
