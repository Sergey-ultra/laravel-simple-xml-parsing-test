<?php

declare(strict_types=1);


namespace App\Service;


use App\Service\Contract\CurrencyServiceInterface;
use Carbon\Carbon;
use GuzzleHttp\Client;
use SimpleXMLElement;

class CurrencyService implements CurrencyServiceInterface
{


    public function __construct(private Client $client){}

    /**
     * @param  \Carbon\Carbon $date
     * @return array|null
     */
    public function getData(Carbon $date): ?array
    {
        $body = $this->getRequest($date);

        if (!is_null($body)) {
            $result = simplexml_load_string($body);
            return $this->xmlToArray($result);
        }

        return null;
    }

    /**
     * @param  \Carbon\Carbon $date
     * @return string|null
     */
    protected function getRequest(Carbon $date): ?string
    {
        $date = $date->format('d/m/Y');
        $url =   config('cbr.cbr_url') . '?date_req='. $date;

        $response = $this->client->request(
            'GET',
            $url,
            [
                'headers' => [
                    'Accept-Encoding' => 'gzip, deflate'
                ],
            ]
        );


        if ((int) $response->getStatusCode() === 200) {
            return $response->getBody()->getContents();
        }
        return null;
    }


    /**
     * @param  \SimpleXMLElement $xml
     * @return array
     */
    protected function xmlToArray(SimpleXMLElement $xml): array
    {
        $res = [];
        foreach ($xml->attributes() as $key => $value) {
            $res[$key]  = (string) $value;
        }
        foreach ($xml->Valute as $item) {
            $new = (array) $item;
            foreach($item->attributes() as $key => $value) {
                $new[$key] = (string) $value;
            }
            unset($new['@attributes']);
            $res['valute'][] = $new;
        };

        return $res;
    }
}