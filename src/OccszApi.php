<?php

namespace Occsz\OccszApi;


use Illuminate\Support\Facades\Log;
use Occsz\OccszApi\HTTP\OCCSZClient;
use Occsz\OccszApi\Models\Arajanlat;
use Occsz\OccszApi\Models\ArajanlatRequest;
use Occsz\OccszApi\Models\KiadmanyRequest;

class OccszApi
{

    private $url;

    private $occszClient;

    /**
     * Request constructor.
     *
     * @param $options
     */
    public function __construct($options = null)
    {
         $this->OCCSZClient = new OCCSZClient();
         //$this->url =  'https://occsztest.e-cegjegyzek.hu/IMOnline';
    }

    public function getPrice($doku, $key, $alairt, $outformat, $lang) {
        $kr = new ArajanlatRequest();
        $kr->doku = $doku;
        $kr->key = $key;
        $kr->alairt = $alairt;
        $kr->outformat = $outformat;
        $kr->lang = $lang;

        $this->config = config('occsz-api');
        $options = $this->config['accounts'][$this->config['accountName']];

        $url = $options['partUrl'];

        try {
            $result = $this->OCCSZClient->get($url, ['query' => $kr->toArray() ] );
            $res = $result->getBody()->getContents();
            $collect= collect(json_decode(json_encode(simplexml_load_string($res)), true));

            $arajanlat = new Arajanlat();
            $arajanlat->ResultCount = $collect['TalálatokSzáma'];
            $arajanlat->Url = $collect['ÁrajánlatUrl'];
            $arajanlat->Currency = $collect['Ártáblázat']['Pénznem'];
            $arajanlat->Price = $collect['Ártáblázat']['Összesen']['Végösszeg'];
            $arajanlat->OutFormat = $outformat;

            return $arajanlat;

        } catch (JSONParseExceptionAlias $e) {
            echo "Error parsing response";
        } catch (RequestErrorExceptionAlias $e) {
            echo "Error in request";
        } catch (GuzzleException $e) {
            var_dump($e->getMessage());
        }
    }

    public function getDocument($arajanlat){
        $outFormat = '&outformat='.$arajanlat->OutFormat;

        try {
            $res = $this->OCCSZClient->get($arajanlat->Url.$outFormat);
            if ($res) {
                $document = $res->getBody()->getContents();

                //$time = Time();

                //if ($arajanlat->SigType == 'alairasnelkul') {
                //    $filename = $time.$arajanlat->ID.'_'.$arajanlat->DocType.'_'.$arajanlat->SigType.'_'.$arajanlat->Language.'.html';
                //} else if ($arajanlat->SigType == 'eszignoval' || $arajanlat->SigType == 'kozokirat') {
                    //$filename = $time.'_'.explode('filename=', $res->getHeader('Content-Disposition')[0])[1];
                //}
                return $document;

            }
        } catch (JSONParseExceptionAlias $e) {
            echo "Error parsing response";
        } catch (RequestErrorExceptionAlias $e) {
            echo "Error in request";
        } catch (GuzzleException $e) {
            var_dump($e->getMessage());
        }


            //$result = $this->OCCSZClient->get($data->url, ['query' => $kr->toArray() ] );
        //$res = $result->getBody()->getContents();
        //$collect= collect(json_decode(json_encode(simplexml_load_string($res)), true));

    }
}
