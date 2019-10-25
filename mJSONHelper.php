<?php

/* merge_array */
function mArrayMerge($arrayA, $arrayB)
{
    foreach($arrayB AS $bKey => $bValue) {
        if(!isset($arrayA[$bKey])) {
            $arrayA[$bKey] = $bValue;
        }
    }
    return $arrayA;
}

/* arraySorter */
function mArraySort(array $data, $assoc = null)
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

$masterArray = json_decode(file_get_contents("files/SPmaster.JSON"), true);
$issueArray = json_decode(file_get_contents("files/SPissue.JSON"), true);

$mergedArray = mArrayMerge($masterArray, $issueArray);
$sortedArray = mArraySort($mergedArray, true);
file_put_contents("files/mergedJSON.json", json_encode($sortedArray, JSON_PRETTY_PRINT));