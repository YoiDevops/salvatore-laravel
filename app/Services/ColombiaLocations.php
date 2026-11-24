<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use UnexpectedValueException;

class ColombiaLocations
{
    private const API_BASE_URL = 'https://api-colombia.com/api/v1';

    /**
     * @return array<int, array{id: int, name: string}>
     */
    public function departments(): array
    {
        return Cache::remember('colombia.departments', now()->addDays(30), fn () => $this->fetchLocations(
            self::API_BASE_URL . '/Department',
        ));
    }

    /**
     * @return array<int, array{id: int, name: string}>
     */
    public function municipalities(int $departmentId): array
    {
        return Cache::remember(
            "colombia.department.{$departmentId}.municipalities",
            now()->addDays(30),
            fn () => $this->fetchLocations(self::API_BASE_URL . "/Department/{$departmentId}/cities"),
        );
    }

    /**
     * @return array<int, array{id: int, name: string}>
     */
    private function fetchLocations(string $url): array
    {
        $response = Http::acceptJson()
            ->connectTimeout(3)
            ->timeout(8)
            ->get($url);

        $response->throw();

        $data = $response->json();

        if (! is_array($data)) {
            throw new UnexpectedValueException('The Colombia locations API returned an invalid response.');
        }

        $locations = [];

        foreach ($data as $location) {
            if (
                ! is_array($location)
                || ! isset($location['id'], $location['name'])
                || ! is_numeric($location['id'])
                || ! is_string($location['name'])
            ) {
                continue;
            }

            $id = (int) $location['id'];
            $name = trim($location['name']);

            if ($id > 0 && $name !== '') {
                $locations[] = ['id' => $id, 'name' => $name];
            }
        }

        if ($locations === []) {
            throw new UnexpectedValueException('The Colombia locations API returned no usable locations.');
        }

        return $locations;
    }
}
