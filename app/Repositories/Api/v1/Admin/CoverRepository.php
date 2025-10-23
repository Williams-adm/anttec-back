<?php

namespace App\Repositories\Api\v1\Admin;

use App\Models\Cover;
use App\Repositories\Api\v1\Admin\Contracts\CoverInterface;
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

/*     public function update(array $data, int $id): ?Model
    {

    } */
}
