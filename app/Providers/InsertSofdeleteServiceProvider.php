<?php

namespace App\Providers;

use App\Models\Phone;
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
        Phone::saving(function ($model) {
            $exist_record = $model->where('phone', $model->phone)
                                  ->where('subject_id', $model->subject_id)
                                  ->first();
            if ($exist_record) {
                $model->exists = true;
                return;
            }
            $restored_record = $model->onlyTrashed()
                                     ->where('phone', $model->phone)
                                     ->where('subject_id', $model->subject_id)
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
