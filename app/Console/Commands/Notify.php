<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\notifyEmail;

class Notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user.notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Emile For Lesson';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $emails = User::pluck('email')->toArray();
        $data = ['title'=> 'programming', 'body'=> 'PHP'];
        foreach ($emails as $email){
            mail::to($email) ->send(new notifyEmail($data));
        };
    }
}
