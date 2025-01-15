<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class StakingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invest:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs invest command when called';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   Log::info('Staking command started.');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => url('api/wallet/investresult'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        Log::info('Staking command completed.');
        return 0;
    }
}
