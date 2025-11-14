<?php

namespace App\Repositories\Api\v1\Admin;

use App\Contracts\Api\v1\Admin\CoverInterface;
use App\Models\Cover;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CoverRepository extends BaseRepository implements CoverInterface
{
    public function __construct(Cover $model)
    {
        parent::__construct($model);
    }

    public function create(array $data): Model
    {
        DB::beginTransaction();
        try{
            $cover = Cover::create([
                'title' => $data['title'],
                'start_at' => $data['start_at'],
                'end_at' => $data['end_at'] ?? null,
            ]);

            $cover->image()->create([
                'path' => $data['image']
            ]);

            DB::commit();

            return $cover->refresh();

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function update(array $coverData, array $imageData, int $id): ?Model
    {
        $cover = $this->model->find($id);

        if (!$cover) {
            return null;
        }

        DB::beginTransaction();
        try {
            if(!empty($coverData)) {
                $cover->update($coverData);
            }

            if (!empty($imageData) && isset($imageData['image'])) {
                $cover->image()->update([
                    'path' => $imageData['image']
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return $cover->refresh();
    }

    public function reorder(array $orderIds): void
    {
        $covers = Cover::whereIn('id', $orderIds)->get()->keyBy('id');

        foreach ($orderIds as $index => $id) {
            if (isset($covers[$id])) {
                $covers[$id]->update(['order' => $index + 1]);
            }
        }
    }
}
