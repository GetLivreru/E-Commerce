<?php

namespace App\UseCases;

use App\Services\ProductServices;
use App\DTO\ProductDTO;

class ProductImportUseCase
{
    protected $service;

    public function __construct(ProductServices $service)
    {
        $this->service = $service;
    }

    public function execute(array $productsData)
    {
        foreach ($productsData as $data) {
            $dto = new ProductDTO($data['id'] ?? null, $data['name'], $data['code']);
            $this->service->createOrUpdate($dto);
        }
    }
}
