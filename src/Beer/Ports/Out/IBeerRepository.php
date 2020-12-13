<?php

namespace Source\Beer\Ports\Out;

use Source\Beer\Domain\Beer;
use Source\Beer\Domain\BeerDTO;

interface IBeerRepository
{
    public function getAll(): array;
    public function getById(string $id): ?Beer;
    public function create(BeerDTO $data): Beer;
    public function update(BeerDTO $data, string $id): ?Beer;
    public function delete(string $id): ?bool;
}
