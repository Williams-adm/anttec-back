<?php

namespace App\Services\Api\v1\Admin;

use App\Contracts\Api\v1\Admin\MovementInterface;
use App\Events\LowStockDetected;
use App\Exceptions\Api\v1\General\InsufficentStockException;
use App\Models\BranchVariant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @extends BaseService<MovementInterface>
 */
class MovementService extends BaseService
{
    public function __construct(MovementInterface $repository)
    {
        parent::__construct($repository);
    }

    public function create(array $data): Model
    {
        if ($data['type'] === 'outflow') {
            foreach ($data['variants'] as $variantData) {
                $variant = BranchVariant::find($variantData['branch_variant_id']);

                if ($variant->stock < $variantData['quantity']) {
                    throw new InsufficentStockException();
                }
            }
            $movement = $this->repository->createOutflow($data);

            $this->checkLowStock($data['variants']);

            return $movement;
        }

        return $this->repository->createInflow($data);
    }

    protected function checkLowStock(array $variants): void
    {
        foreach ($variants as $variantData) {
            $variant = BranchVariant::with([
                'variant.product',
                'variant.optionProductValues.optionValue.option'
            ])->find($variantData['branch_variant_id']);

            $minimumStock = $variant->stock_min ?? 5;

            if ($variant->stock <= $minimumStock) {
                // Construir el nombre con características
                $productName = $this->buildProductName($variant);

                $userId = Auth::id();

                LowStockDetected::dispatch(
                    $variant->id,
                    $productName,
                    $variant->stock,
                    $minimumStock,
                    $variant->variant->sku ?? 'Sin SKU',
                    $userId
                );
            }
        }
    }

    /**
     * Construye el nombre del producto con sus características
     * Ejemplo: "Camiseta (color: negro | talla: L)"
     */
    protected function buildProductName(BranchVariant $variant): string
    {
        $baseName = $variant->variant->product->name ?? 'Producto desconocido';

        // Obtener las características del variant
        $features = $variant->variant->optionProductValues->map(function ($feature) {
            $optionName = $feature->optionValue->option->name ?? 'Opción';
            $value = $feature->optionValue->description ?? 'N/A';

            return strtolower($optionName) . ': ' . $value;
        })->join(' | ');

        // Si hay características, agregarlas
        if ($features) {
            return $baseName . ' (' . $features . ')';
        }

        return $baseName;
    }
}
