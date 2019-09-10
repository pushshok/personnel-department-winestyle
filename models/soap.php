<?php

$pay = isset($_GET['pay']) ? strip_tags(htmlspecialchars($_GET['pay'])) : "";
$bounty = isset($_GET['bounty']) ? strip_tags(htmlspecialchars($_GET['bounty'])) : "";

function getUSD($pay, $bounty)
{
    $courseUSD = "";
    try {
        $client = new SoapClient('https://www.cbr.ru/DailyInfoWebServ/DailyInfo.asmx?WSDL');

        $data = date('Y-m-d');
        $course = new \SimpleXMLElement($client->GetCursOnDateXML(['On_date' => $data])->GetCursOnDateXMLResult->any);

        if ($course) {

            foreach ($course->ValuteCursOnDate as $currency) {
                if ($currency->VchCode == 'USD') {
                    $courseUSD = floatval($currency->Vcurs);
                }
            }
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }

    if ($pay != 0) {
        $payUSD = round($pay / $courseUSD, 2);
    } else {
        $payUSD = 0;
    }

    if ($bounty != 0) {
        $bountyUSD = round($bounty / $courseUSD, 2);
    } else {
        $bountyUSD = 0;
    }

    echo json_encode(array($payUSD, $bountyUSD));
}

getUSD($pay, $bounty);

