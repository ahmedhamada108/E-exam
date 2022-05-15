<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\exam;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DeleteExamCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete_exam:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
       return exam::where('end_at','<=', Carbon::now()->timestamp )->delete();
    }
}
