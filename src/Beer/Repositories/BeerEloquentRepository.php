<?php

namespace Source\Beer\Repositories;

use App\Models\Beer as BeerModel;
use Source\Beer\Domain\{Beer, BeerDTO};
use Illuminate\Database\Eloquent\Model;
use Source\Beer\Ports\Out\IBeerRepository;

class BeerEloquentRepository implements IBeerRepository
{

    public function getAll(): array
    {
        return BeerModel
            ::all()
            ->map(function ($beer) {
                return new Beer(
                    $beer->id,
                    $beer->name,
                    $beer->description,
                    $beer->ibu,
                    $beer->abv,
                    $beer->image
                );
            })
            ->toArray();
    }

    public function getById(string $id): ?Beer
    {
        $beer = $this->find($id);

        if (!$beer) {
            return null;
        }

        return new Beer(
            $beer->id,
            $beer->name,
            $beer->description,
            $beer->ibu,
            $beer->abv,
            $beer->image
        );
    }

    public function create(BeerDTO $data): Beer
    {
        return $this->save(new BeerModel(), $data);
    }

    public function update(BeerDTO $data, string $id): ?Beer
    {
        $beer = $this->find($id);

        if (!$beer) {
            return null;
        }

        return $this->save($beer, $data);
    }

    public function delete(string $id): ?bool
    {
        $beer = $this->find($id);

        if (!$beer) {
            return null;
        }

        return $beer->delete();
    }

    protected function find(string $id): ?Model
    {
        return BeerModel::query()->find($id);
    }

    protected function save(Model $beer, BeerDTO $data): Beer
    {
        $beer->name = $data->name;
        $beer->description = $data->description;
        $beer->ibu = $data->ibu;
        $beer->abv = $data->abv;
        $beer->image = $data->image->name;
        $beer->save();

        return new Beer(
            $beer->id,
            $beer->name,
            $beer->description,
            $beer->ibu,
            $beer->abv,
            $beer->image
        );
    }
}
