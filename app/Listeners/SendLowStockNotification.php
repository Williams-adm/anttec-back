<?php

namespace App\Listeners;

use App\Events\LowStockDetected;
use App\Mail\LowStockAlert;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendLowStockNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public $connection = 'rabbitmq';
    public $queue = 'low-stock-notifications';

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(LowStockDetected $event): void
    {
        $admin = User::find($event->userId);

        if (!$admin || !$admin->email) {
            Log::warning('Admin user not found for low stock notification', [
                'userId' => $event->userId ?? 'not_provided'
            ]);
            return;
        }

        Mail::to($admin->email)
            ->send(new LowStockAlert(
                $event->productName,
                $event->currentStock,
                $event->minimumStock,
                $event->sku
            ));
    }

    public function failed(LowStockDetected $event, \Throwable $exception): void
    {
        // Manejar fallos (opcional)
        Log::error('Failed to send low stock notification', [
            'product' => $event->productName,
            'error' => $exception->getMessage()
        ]);
    }
}
