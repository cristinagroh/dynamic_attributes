<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\ExchangeRate;
use Illuminate\Support\Facades\Log;

class GetBnrExchangeRateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-bnr-exchange-rate-command
                            {currencies : The currencies you want to bring}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    private $currencies;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->currencies = explode(',',$this->argument('currencies'));
        if(empty($this->currencies)){
            Log::critical('No currency mentioned ! Command stopping.');
            return;
        }
        $this->getExchangeRate();
    }

    private function getExchangeRate()
    {
        $tomorrow = Carbon::tomorrow()->toDateString();
        $isCurrencySet = ExchangeRate::where('date', $tomorrow)
        ->get()
        ->first();

        if(!isset($isCurrencySet)) {
            $xmlDocument = $this->getFromUrl("https://www.bnro.ro/nbrfxrates.xml", false);
            if(!isset($xmlDocument) || $xmlDocument === false){
                Log::critical('Could not get data from BNR');
                return;
            }
            $xml = new \SimpleXMLElement($xmlDocument);
            $targetDate = Carbon::createFromFormat('Y-m-d', (string)$xml->Header->PublishingDate);
            
            do {
                $targetDate->addDays(1);
                foreach($xml->Body->Cube->Rate as $line) {
                    if (!in_array(strtoupper(trim($line['currency'])), $this->currencies, true)) {
                        continue;
                    }
                    $currency = new ExchangeRate();
                    $currency->currency = strtoupper(trim($line['currency']));
                    $value = isset($line['multiplier']) ? floatVal((string)$line) / $line['multiplier'] : floatVal((string)$line);
                    $currency->value = $value;
                    $currency->date = $targetDate->toDateString();
                    $currency->save();
                }
            } while($targetDate->isWeekend()); // se va popula pana in weekend
        }
    }

    public static function getFromUrl($url, $timeoutSeconds = 5)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 5,
            CURLOPT_TIMEOUT => $timeoutSeconds,
        ]);
        
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $err = curl_error($curl);
        curl_close($curl);
        if ($httpcode != 200 || $err != '') {
            return null;
        }

        return $response;
    }
}
