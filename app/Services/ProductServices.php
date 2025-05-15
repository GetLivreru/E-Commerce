<?php

namespace App\Services;

use App\DTO\ProductDTO;
use App\Models\Product;
use App\Repositories\ProductRepository;

class ProductServices
{
    protected $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createOrUpdate(ProductDTO $dto)
    {
        $product = $this->repository->findByCode($dto->code);
        if ($product) {
            $product->name = $dto->name;
        } else {
            $product = new Product([
                'name' => $dto->name,
                'code' => $dto->code,
            ]);
        }
        return $this->repository->save($product);
    }
}
