<?php
function mySort(array $data, $assoc = null)
{
    $toSort = $data;
    if ($assoc) {
        $toSort = array_keys($toSort);
    }
    $result = natcasesort($toSort);
    if ($result && $assoc) {
        $sortedAssoc = [];
        foreach($toSort as $sortedKey) {
            $sortedAssoc[$sortedKey] = $data[$sortedKey];
        }
        return $sortedAssoc;
    } elseif ($result) {
        return $toSort;
    }
    return $data;
}
$originalContent = file_get_contents("jsontest.json");
$detectedEncoding = mb_detect_encoding($originalContent, mb_detect_order(), true);
$unsortedJSON = json_decode($originalContent, true);

unset($originalContent);

$sortedJSON = mySort($unsortedJSON, true);
$encodedJSONString = mb_convert_encoding(json_encode($sortedJSON, JSON_PRETTY_PRINT), 'ISO-8859-1', $detectedEncoding);
file_put_contents("jsonresult.json", $encodedJSONString);