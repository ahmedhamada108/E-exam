<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\exam;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class StopExamCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stop_exam:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'stop the exam after finish the time';

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
        Log::info("Cron is working fine!");
       return exam::where('end_at','<=', Carbon::now()->timestamp)->update([
           'Is_available'=>0
       ]);
    }
}
