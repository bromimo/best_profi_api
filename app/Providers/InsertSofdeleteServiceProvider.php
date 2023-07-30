<?php

namespace App\Providers;

use App\Models\Phone;
use App\Models\Telegram;
use App\Models\Instagram;
use Illuminate\Support\ServiceProvider;

class InsertSofdeleteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->modelSaving(Phone::class, 'phone');
        $this->modelSaving(Instagram::class, 'account');
        $this->modelSaving(Telegram::class, 'account');
    }

    /** Игнорирует вставляемую запись, если она уже есть в БД. Если вставляемая запись числится в удаленных -
     * восстанавливает ее.
     * @param        $model
     * @param string $column
     * @param string $parent_column
     * @return void
     */
    private function modelSaving($model, string $column, string $parent_column = 'subject_id'): void
    {
        $model::saving(function ($model) use ($column, $parent_column) {
            $exist_record = $model->where($column, $model->$column)
                                  ->where($parent_column, $model->$parent_column)
                                  ->first();
            if ($exist_record) {
                $model->exists = true;

                return;
            }
            $restored_record = $model->onlyTrashed()
                                     ->where($column, $model->$column)
                                     ->where($parent_column, $model->$parent_column)
                                     ->first();
            if ($restored_record) {
                $restored_record->withoutEvents(function () use ($restored_record) {
                    $restored_record->restore();
                });
                $model->exists = true;

                return;
            }
        });
    }
}
