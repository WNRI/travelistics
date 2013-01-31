<?php
/*
 * @params to be added and replace hardcoded valuestoken_auth , idsite, piwik_url, site url, action name
 * 
 */
require_once "PiwikTracker.php";
if (php_sapi_name() != 'cli') {
    die("Please run run the script from command line");
}

if ($argc < 1) {
    die("Please give csv file path as first parameter!");
}

@$csv = fopen($argv[1], "r");

if ($csv === false) {
    die("Filename " . $argv[1] . " is invalid" . PHP_EOL);
}

$countries = fgetcsv($csv);
// row = single day
// cell = count of visits
// key = col number
// countries[key] = column translated to country code
$index = 0;
while ($row = fgetcsv($csv)) {
    $date = date("Y-m-d H:i:s", strtotime($row[0] . " 09:00:00"));

    foreach ($row as $key => $cell) {
        if ($key > 0 && $cell != "" && $cell > 0) {
            // determine current country code
            $country = $countries[$key] != "ZZ" ? $countries[$key] : "";
            for ($i = 0; $i < $cell; $i++) {
                $piwikTracker = new PiwikTracker($idSite = 1, "http://ec2-54-228-7-91.eu-west-1.compute.amazonaws.com/piwik");
                $piwikTracker->setUrl("http://museumsite.com");
                $piwikTracker->setTokenAuth("11587df394a70647b76cacc2ef54f537");
                $piwikTracker->setCountry($country);
                $piwikTracker->setForceVisitDateTime($date);
                $piwikTracker->doTrackPageView("Museum visit");
//                echo "Tracking date : " . $row[0] . " , country: " . $country . ", visitor_id: " . $piwikTracker->getVisitorId() . " entry nb: " . $index . PHP_EOL;
                $index++;
            }
        }
    }
}

