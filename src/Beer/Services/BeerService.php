<?php

namespace Source\Beer\Services;

use Source\Beer\Domain\{Beer, BeerDTO, ValueObjects\Base64};
use Core\Base64 as Base64Decoder;
use Illuminate\Contracts\Filesystem\Filesystem;
use Source\Beer\Ports\In\IBeerService;
use Source\Beer\Ports\Out\IBeerRepository;

class BeerService implements IBeerService
{
    public function __construct(
        protected IBeerRepository $beerRepository,
        protected Filesystem $storage
    ) {}

    public function list(): array
    {
        return $this->beerRepository->getAll();
    }

    public function show(string $id): ?Beer
    {
        return $this->beerRepository->getById($id);
    }

    public function create(BeerDTO $data): Beer
    {
        $beer = $this->beerRepository->create($data);
        $this->saveFile($data->image);

        return $beer;
    }

    public function update(BeerDTO $data, string $id): ?Beer
    {
        $beer = $this->beerRepository->update($data, $id);
        $this->saveFile($data->image);

        return $beer;
    }

    public function delete(string $id): ?bool
    {
        return $this->beerRepository->delete($id);
    }

    private function saveFile(Base64 $image): void
    {
        $this->storage->put($image->name, Base64Decoder::decode($image->base64));
    }
}
