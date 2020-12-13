<?php

namespace App\Http\Controllers;

use App\Http\Requests\BeerRequest;
use Illuminate\Http\JsonResponse;
use Source\Beer\Domain\BeerDTO;
use Source\Beer\Domain\ValueObjects\Base64;
use Source\Beer\Ports\In\IBeerService;

class BeerController extends Controller
{
    public function __construct(
        protected IBeerService $beerService
    ) {}

    public function index(): JsonResponse
    {
        $data = $this->beerService->list();

        return response()->json($data);
    }

    public function store(BeerRequest $request): JsonResponse
    {
        $data = $this
            ->beerService
            ->create(new BeerDTO(
                $request->get('name'),
                $request->get('description'),
                $request->get('ibu'),
                $request->get('abv'),
                new Base64(...$request->get('image'))
            ));

        return response()->json($data, 201);
    }

    public function show(string $id): JsonResponse
    {
        $data = $this->beerService->show($id);

        if (!$data) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json($data);
    }

    public function update(BeerRequest $request, string $id): JsonResponse
    {
        $data = $this
            ->beerService
            ->update(new BeerDTO(
                $request->get('name'),
                $request->get('description'),
                $request->get('ibu'),
                $request->get('abv'),
                new Base64(...$request->get('image'))
            ), $id);

        if (!$data) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json($data);
    }

    public function destroy(string $id): JsonResponse
    {
        $data = $this->beerService->delete($id);

        if (!$data) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json([], 204);
    }
}
