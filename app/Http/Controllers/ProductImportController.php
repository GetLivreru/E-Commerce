<?php

namespace App\Http\Controllers;

use App\UseCases\ProductImportUseCase;
use Illuminate\Support\Facades\Http;

class ProductImportController extends Controller
{
    public function import(ProductImportUseCase $useCase)
    {
        $response = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',
            'Accept' => 'application/json',
        ])->get('https://www.mechta.kz/api/v2/filter/catalog?properties&section=smartfony');

        if ($response->failed()) {
            return response()->json(['error' => 'Не удалось получить данные с mechta.kz'], 500);
        }

        $data = $response->json();

        $productsData = [];
        foreach ($data['data']['properties'] as $property) {
            if ($property['property_name'] === 'Модель') {
                foreach ($property['items'] as $item) {
                    $productsData[] = [
                        'name' => $item['value'],
                        'code' => $item['code'],
                    ];
                }
            }
        }

        $useCase->execute($productsData);

        return response()->json(['status' => 'Импорт завершён!']);
    }
}
