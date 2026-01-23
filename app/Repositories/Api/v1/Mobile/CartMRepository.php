<?php

namespace App\Repositories\Api\v1\Mobile;

use App\Contracts\Api\v1\Mobile\CartMInterface;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Model;

class CartMRepository implements CartMInterface
{
    public function getCart(int $userId): ?Model
    {
        return Cart::with([
            'branchVariants' => function ($q) {
                $q->with([
                    'variant' => function ($q) {
                        $q->with([
                            'product.brand',
                            'images',
                            'optionProductValues.optionValue.option',
                        ]);
                    },
                ]);
            },
        ])->where('user_id', $userId)->where('status', 'active')->first();
    }

    public function getOrCreateCart(int $userId): ?Model
    {
        $cart = $this->getCart($userId);
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $userId,
                'expires_at' => now()->addDays(30)
            ]);
        }

        return $cart->refresh();
    }

    //verificar
    public function update(int $id, array $data): Model
    {
        $model = Cart::findOrFail($id);
        $model->update($data);
        return $model->refresh();
    }
}
