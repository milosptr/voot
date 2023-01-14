<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Events\ProcessOrder;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ProcessOrderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send emails for processing order and save it in AX';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      $orders = Order::where('processed', 0)->orderBy('id', 'DESC')->get();
      foreach($orders as $order) {
        try {
          Log::info('Processing order '. $order->id);
          ProcessOrder::dispatch($order);
        } catch (Exception $e) {
          Log::error('SendOrderEmailsCommand error'.$e->getMessage());
          Log::error('SendOrderEmailsCommand for order #'.$order->id);
          continue;
        }
      }
      return Command::SUCCESS;
    }
}
