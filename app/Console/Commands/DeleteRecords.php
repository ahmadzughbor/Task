<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteRecords extends Command
{
    protected $signature = 'delete-records';

    public function handle()
    {
        DB::table('categories')->where('created_at', '<=', Carbon::now()->addDay(30))->delete();
    }
}
