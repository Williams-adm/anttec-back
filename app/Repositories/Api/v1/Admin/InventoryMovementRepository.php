<?php

namespace App\Repositories\Api\v1\Admin;

use App\Contracts\Api\v1\Admin\InventoryMovementInterface;
use App\Models\InventoryMovement;
use Illuminate\Support\Facades\DB;

class InventoryMovementRepository extends BaseRepository implements InventoryMovementInterface
{
    public function __construct(InventoryMovement $model)
    {
        parent::__construct($model);
    }

    public function createInflow(array $data): array
    {
        $inflows = [];
        DB::transaction(function () use ($data, &$inflows) {
            foreach ($data['variants'] as $inflowVariant) {
                $inflow = $this->model->create([
                    'type' => $data['type'],
                    'detail_transaction' => $data['detail_transaction'],
                    'branch_variant_id' => $inflowVariant['branch_variant_id'],
                    'quantity' => $inflowVariant['quantity'],
                ])->refresh();

                $inflow->branchVariant()->increment(
                    'stock',
                    $inflowVariant['quantity']
                );

                $inflows[] = $inflow;
            }
        });

        return $inflows;
    }

    public function createOutflow(array $data): array
    {
        $outflows = [];
        DB::transaction(function () use ($data, &$outflows){
            foreach ($data['variants'] as $outflowVariant) {
                $outflow = $this->model->create([
                    'type' => $data['type'],
                    'detail_transaction' => $data['detail_transaction'],
                    'branch_variant_id' => $outflowVariant['branch_variant_id'],
                    'quantity' => $outflowVariant['quantity'],
                ])->refresh();

                $outflow->branchVariant()->decrement(
                    'stock',
                    $outflowVariant['quantity']
                );

                $outflows[] = $outflow;
            }
        });

        return $outflows;
    }
}
