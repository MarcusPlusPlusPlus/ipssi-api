<?php

declare(strict_types=1);

namespace App\Tests\SnapshotDriver;

use PHPUnit\Framework\Assert;
use Spatie\Snapshots\Driver;
use Spatie\Snapshots\Exceptions\CantBeSerialized;
use Symfony\Component\HttpFoundation\Response;

class SymfonyResponseDriver implements Driver
{
    public function serialize($response): string
    {
        if (!$response instanceof Response) {
            throw new CantBeSerialized('Only Symfony\Component\HttpFoundation\JsonResponse can be serialized');
        }

        $data = [
            'statusCode' => $response->getStatusCode(),
            'headers' => $this->formatHeaders($response),
            'body' => json_decode($response->getContent(), true),
        ];

        return json_encode($data, JSON_PRETTY_PRINT) . PHP_EOL;
    }

    private function formatHeaders(Response $response): array
    {
        $headers = $response->headers->allPreserveCase();
        unset(
            $headers['Date'],
            $headers['Set-Cookie'],
            $headers['X-Debug-Token'],
            $headers['X-Previous-Debug-Token']
        );

        return $headers;
    }

    public function match($expected, $actual)
    {
        Assert::assertJsonStringEqualsJsonString($expected, $this->serialize($actual));
    }

    public function extension(): string
    {
        return 'sf_response.json';
    }
}
