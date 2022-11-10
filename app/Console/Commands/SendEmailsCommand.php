<?php

namespace App\Console\Commands;

use App\Models\Email;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending an scheduled emails from emails table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $emails = Email::whereNull('sent_at')->where('tries', '<', 3)->take(10)->get();
        foreach ($emails as $email) {
          if($email->class && $email->to) {
            try {
              Mail::to($email->to)->send(new $email->class($email->order));
              $email->sent_at = Carbon::now();
              $email->save();
            } catch(Exception $e) {
              $email->tries = $email->tries + 1;
              $email->save();
              Log::error('Email not sent to '. $email->to .' - class '. $email->class . ' - email id ' . $email->id . '!' . ' '. $e->getMessage());
            }
          }
        }
        return 0;
    }
}
