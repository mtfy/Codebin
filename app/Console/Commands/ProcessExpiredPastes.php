<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Paste;
use Illuminate\Support\Facades\Log;

class ProcessExpiredPastes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-expired-pastes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch job to soft delete expired pastes in the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
		$now = Carbon::now('UTC');
		try {
			Paste::select('id')->where('expire', '<=', $now)->get()->map(function ($paste) {
				if (!$paste->trashed()) {
					$paste->delete();
					Log::info( 'Soft deleted paste with ID ' . \number_format(\floatval($paste->id), 0) );
				}
			});
		} catch (\Throwable $ex) {}
    }
}
