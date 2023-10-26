<?php

function csvToJson($csvFile) {
    $csvData = [];

    if (($handle = fopen($csvFile, 'r')) !== false) {
        while (($row = fgetcsv($handle)) !== false) {
            $csvData[] = $row;
        }
        fclose($handle);

        $headers = array_shift($csvData);

        $jsonArray = [];

        foreach ($csvData as $row) {
            $jsonArrayItem = [];
            for ($i = 0; $i < count($headers); $i++) {
                $jsonArrayItem[$headers[$i]] = $row[$i];
            }
            $jsonArray[] = $jsonArrayItem;
        }    

        return json_encode($jsonArray);
    } else {
        return json_encode(['error' => 'Failed to open CSV file']);
    }
}

$csvFile = 'datapribadi.csv';
$jsonData = csvToJson($csvFile);

// Output the JSON data
echo $jsonData;
?>
