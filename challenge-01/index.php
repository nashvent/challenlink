<?php

function findPoint($strArr)
{
    $firstList = array_map("intval", explode(",", $strArr[0]));
    $secondList = array_map("intval", explode(",", $strArr[1]));
    $max = (end($firstList) > end($secondList)) ? end($firstList) : end($secondList);  
    $countArray = array_fill(0, $max + 1, 0);

    foreach($firstList as $number){
        $countArray[$number] += 1;
    }

    foreach($secondList as $number){
        $countArray[$number] += 1;
    }
    
    $resultList = [];
    foreach($countArray as $index=>$counter){
        if($counter>1){
            array_push($resultList, $index);
        }
    }
    return [ count($resultList)>0 ? implode(", ",$resultList) : "false"];
}

// keep this function call here
print_r (findPoint(['3, 4, 7, 13', '1,4, 2, 13, 15']) );

?>