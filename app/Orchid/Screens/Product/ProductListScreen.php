<?php

namespace App\Orchid\Screens\Product;

use App\Models\Product;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;

class ProductListScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'products' => Product::query()
                ->orderByDesc('id')
                ->paginate(),
        ];
    }

    public function name(): ?string
    {
        return 'Продукты';
    }

    public function description(): ?string
    {
        return 'Список всех продуктов';
    }

    public function commandBar(): iterable
    {
        return [
            Link::make('Создать новый')
                ->icon('pencil')
                ->route('platform.product.edit')
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::table('products', [
                TD::make('id')
                    ->sort()
                    ->filter(TD::FILTER_TEXT)
                    ->render(fn (Product $product) => Link::make($product->id)
                        ->route('platform.product.edit', ['product' => $product])),

                TD::make('name', 'Название')
                    ->sort()
                    ->filter(TD::FILTER_TEXT)
                    ->render(fn (Product $product) => Link::make($product->name)
                        ->route('platform.product.edit', ['product' => $product])),

                TD::make('code', 'Код')
                    ->sort()
                    ->filter(TD::FILTER_TEXT),

                TD::make('created_at', 'Создан')
                    ->sort()
                    ->render(fn (Product $product) => $product->created_at->toDateTimeString()),

                TD::make('updated_at', 'Обновлен')
                    ->sort()
                    ->render(fn (Product $product) => $product->updated_at->toDateTimeString()),

                TD::make('Actions', 'Действия')
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(fn (Product $product) => Link::make('Редактировать')
                        ->route('platform.product.edit', ['product' => $product])),
            ]),
        ];
    }
} 