<?php

namespace App\RequestClients;


class Currency
{
    // Get currency exchange rate from EU central bank. Only retrieve USD rate for EUR

    public static function getCurrency()
    {

            $xml_string = file_get_contents("https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");
            $xml = new \SimpleXMLElement($xml_string);
            $cxml = $xml->xpath('//*[@currency]');
            //anchored to USD in this case
            $usx = $xml->xpath('//*[@currency="USD"]');
            $base = floatval(strval($usx[0]['rate']));

            return number_format($base, 2, '.','');

    }

}