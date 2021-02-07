<?php

$data = file_get_contents("KHM.json");
$log = '';
$res = '';
$sortedCards = [];
$userCards = '';
$cards = '';

$json = json_decode($data, true);

$cards = $json['cards'];
if (file_exists("uploads/log.log")) {
    rename("uploads/log.log", "uploads/log.txt");
}

$log = @file_get_contents("uploads/log.txt");

$start = strpos($log, '[UnityCrossThreadLogger]<== PlayerInventory.GetPlayerCardsV3');
$cut1 = substr($log, $start);
//echo $cut1;
$cut2 = explode("}}", $cut1);
//var_dump($cut2);
$finalCut = explode(" ", $cut2[0]);
//var_dump($finalCut);
if (count($finalCut) > 1) {
    $res = $finalCut[2] . "}}";
}

//var_dump($res);
//echo $res;

//echo $res;

//var_dump($cards);


$json2 = json_decode($res, true);
if (!is_null($json2)) {
    $userCards = $json2['payload'];
}

$noDupes = [];

$prev = '';
foreach ($cards as $k => $v) {

    if (in_array($cards[$k]['name'], $noDupes)) {
        unset($cards[$k]);
    }

    if ($v['rarity'] == 'common') {
        unset($cards[$k]);
    }
    $noDupes[] = $v['name'];
    array_unique($noDupes);
}

//var_dump($userCards);

$sortedCards = sortCards($userCards, $cards);

//var_dump($sortedCards);


function sortCards($uc, $data)
{

    $sortedCards = [];

    if (is_array($uc)) {
        foreach ($uc as $k => $v) {
            //echo $k . " " . $v . " ";
            foreach ($data as $c => $i) {
                if ($data[$c]['identifiers']['mtgArenaId'] == $k) {

                    $temp = [];
                    $temp['collected'] = $v;
                    $temp['name'] = $data[$c]['name'];
                    $temp['rarity'] = ucwords($data[$c]['rarity']);
                    $temp['colors'] = $data[$c]['colors'];
                    $temp['setCode'] = $data[$c]['setCode'];
                    $temp['mtgid'] = $k;

                    $sortedCards[] = $temp;
                }
            }
        }
    }


    return $sortedCards;
}