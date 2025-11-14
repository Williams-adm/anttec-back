<?php

namespace App\Repositories\Api\v1\Admin;

use App\Contracts\Api\v1\Admin\OptionInterface;
use App\Models\Option;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OptionRepository extends BaseRepository implements OptionInterface
{
    public function __construct(Option $model)
    {
        parent::__construct($model);
    }

    public function create(array $data): Model
    {
        DB::beginTransaction();
        try{
            $option = Option::create([
                'name' => $data['name'],
                'type' => $data['type'],
            ]);

            foreach ($data['option_values'] as $optionValue) {
                $option->optionValues()->create([
                    'value' => $optionValue['value'],
                    'description' => $optionValue['description']
                ]);
            }

            DB::commit();

            return $option->refresh();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function update(array $data, int $id): ?Model
    {
        $model = $this->model->find($id);

        if (!$model) {
            return null;
        }

        $model->update($data);
        return $model;
    }
}
