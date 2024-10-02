<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CurrencyController extends Controller
{

    public function index()
    {
        $currencies = Currency::all();
        return view('currency.index', ['currencies'=>$currencies]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=> ['required','string'],
            'rate'=> ['required','numeric', 'min:0'],
        ]);
        $currency = Currency::create($data);
        return to_route('currency.index');
    }

    /**
     * Populates currencies table with data from the API
     */
    public function create()
    {
        $apiKey = '';
        
        // Create a new Guzzle client instance
        $client = new Client(['verify' => false]);

        // API endpoint URL
        //$apiUrl = "https://api.exchangeratesapi.io/v1/latest?access_key={$apiKey}";

        try {
            $testmode = true;
            if($testmode){
                //test mode with harcoded rates to avoid using API quota
                $data = json_decode('{"success":true,"timestamp":1727830456,"base":"EUR","date":"2024-10-02","rates":{"AED":4.064219,"AFN":74.68578,"ALL":98.06362,"AMD":428.337883,"ANG":1.992691,"AOA":1056.149882,"ARS":1073.004974,"AUD":1.607936,"AWG":1.991702,"AZN":1.883474,"BAM":1.95039,"BBD":2.232408,"BDT":132.124714,"BGN":1.955663,"BHD":0.417087,"BIF":3201.660221,"BMD":1.106501,"BND":1.423549,"BOB":7.639258,"BRL":6.003314,"BSD":1.105633,"BTC":1.813583e-5,"BTN":92.66896,"BWP":14.432923,"BYN":3.618199,"BYR":21687.416735,"BZD":2.228458,"CAD":1.492277,"CDF":3172.890808,"CHF":0.93631,"CLF":0.03626,"CLP":1000.531314,"CNY":7.787541,"CNH":7.773606,"COP":4670.838859,"CRC":573.105176,"CUC":1.106501,"CUP":29.322273,"CVE":110.650561,"CZK":25.289092,"DJF":196.647544,"DKK":7.458889,"DOP":66.945735,"DZD":146.718196,"EGP":53.369085,"ERN":16.597513,"ETB":133.771929,"EUR":1,"FJD":2.423901,"FKP":0.842666,"GBP":0.833372,"GEL":3.015184,"GGP":0.842666,"GHS":17.526967,"GIP":0.842666,"GMD":76.897726,"GNF":9555.195111,"GTQ":8.546372,"GYD":231.192018,"HKD":8.597462,"HNL":27.540481,"HRK":7.523111,"HTG":145.887982,"HUF":397.867281,"IDR":16904.788095,"ILS":4.16753,"IMP":0.842666,"INR":92.823638,"IQD":1449.516119,"IRR":46569.851461,"ISK":149.897675,"JEP":0.842666,"JMD":174.037266,"JOD":0.784173,"JPY":159.139714,"KES":142.738571,"KGS":93.213068,"KHR":4497.92609,"KMF":492.337657,"KPW":995.850141,"KRW":1463.120535,"KWD":0.338059,"KYD":0.921278,"KZT":531.984413,"LAK":24098.414937,"LBP":99142.476788,"LKR":326.274998,"LRD":214.412194,"LSL":19.242206,"LTL":3.267209,"LVL":0.669311,"LYD":5.239263,"MAD":10.795581,"MDL":19.29708,"MGA":5029.04637,"MKD":61.592225,"MMK":3593.871611,"MNT":3759.889852,"MOP":8.852206,"MRU":43.999961,"MUR":50.920615,"MVR":16.995543,"MWK":1916.844583,"MXN":21.711041,"MYR":4.610758,"MZN":70.683118,"NAD":19.241929,"NGN":1846.008089,"NIO":40.664322,"NOK":11.747908,"NPR":148.269399,"NZD":1.75973,"OMR":0.426003,"PAB":1.105554,"PEN":4.103182,"PGK":4.33942,"PHP":62.362089,"PKR":307.304859,"PLN":4.287193,"PYG":8616.25648,"QAR":4.028826,"RON":4.975162,"RSD":117.034015,"RUB":106.05868,"RWF":1475.518889,"SAR":4.151391,"SBD":9.175729,"SCR":15.070248,"SDG":665.56201,"SEK":11.373202,"SGD":1.425129,"SHP":0.842666,"SLE":25.28056,"SLL":23202.763965,"SOS":631.811914,"SRD":33.96517,"STD":22902.333658,"SVC":9.674254,"SYP":2780.11652,"SZL":19.137264,"THB":35.977885,"TJS":11.77419,"TMT":3.872753,"TND":3.370379,"TOP":2.591534,"TRY":37.852083,"TTD":7.500129,"TWD":35.167899,"TZS":3009.68268,"UAH":45.679709,"UGX":4055.750401,"USD":1.106501,"UYU":45.962926,"UZS":14102.353026,"VEF":4008357.472418,"VES":40.803965,"VND":27230.986013,"VUV":131.366004,"WST":3.095395,"XAF":654.095418,"XAG":0.035318,"XAU":0.000416,"XCD":2.990375,"XDR":0.815922,"XOF":652.283719,"XPF":119.331742,"YER":276.984858,"ZAR":19.239389,"ZMK":9959.836309,"ZMW":28.993483,"ZWL":356.292823}}', true);
            }
            else{
                // Make a GET request to the Exchangerates api API
                //$response = $client->get($apiUrl);

                // Get the response body as an array
                $data = json_decode($response->getBody(), true);
            }
            
            $currencies = [];
            foreach ($data["rates"] as $key => $value) {
                array_push(
                    $currencies, 
                    ['id'=> $key,
                    'name'=> $key,
                    'rate'=> $value,
                ]);
            }
            Currency::upsert($currencies, ['id'], ['rate']);
            return to_route('currency.index');
        } catch (\Exception $e) {
            // Handle any errors that occur during the API request
            return view('currency.api_error', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $currency)
    {
        $currency->delete();
        return to_route('currency.index')->with('message','Currency deleted');
    }
}
