<?php

namespace Source\Beer\Ports\In;

use Source\Beer\Domain\Beer;
use Source\Beer\Domain\BeerDTO;

interface IBeerService
{
    public function list(): array;
    public function show(string $id): ?Beer;
    public function create(BeerDTO $data): Beer;
    public function update(BeerDTO $data, string $id): ?Beer;
    public function delete(string $id): ?bool;
}
