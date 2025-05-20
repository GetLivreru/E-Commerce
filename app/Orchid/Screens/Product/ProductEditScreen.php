<?php

namespace App\Orchid\Screens\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;

class ProductEditScreen extends Screen
{
    public $product;

    public function query(Product $product): iterable
    {
        return [
            'product' => $product
        ];
    }

    public function name(): ?string
    {
        return $this->product->exists ? 'Редактировать продукт' : 'Создать продукт';
    }

    public function description(): ?string
    {
        return 'Детали продукта';
    }

    public function commandBar(): iterable
    {
        return [
            Button::make('Создать продукт')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->product->exists),

            Button::make('Обновить')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->product->exists),

            Button::make('Удалить')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->product->exists),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('product.name')
                    ->title('Название')
                    ->placeholder('Название продукта')
                    ->help('Укажите название продукта'),

                Input::make('product.code')
                    ->title('Код')
                    ->placeholder('Код продукта')
                    ->help('Укажите код продукта'),
            ]),
        ];
    }

    public function createOrUpdate(Product $product, Request $request)
    {
        $product->fill($request->get('product'))->save();
        return redirect()->route('platform.product.list');
    }

    public function remove(Product $product)
    {
        $product->delete();
        return redirect()->route('platform.product.list');
    }
} 