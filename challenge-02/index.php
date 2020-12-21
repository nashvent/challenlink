<?php

define("infinity_integer", 100000000000000);

function createHashArrayFromString($str){
    $strArr = str_split($str);
    $valArr = array_fill(0, count($strArr), 1); 
    return array_combine($strArr, $valArr);
}

function noIterate($strArr)
{
    $strSource = str_split($strArr[0]);
    $charsToSearch = str_split($strArr[1]);

    $strSourceCounter = [];
    $charToSearchCounter = [];

    foreach($charsToSearch as $key=>$char){
        if(array_key_exists($char,$charToSearchCounter)){
            $charToSearchCounter[$char]+=1;
        }
        else{
            $charToSearchCounter[$char]=1;
        }
    }

    $globalStartIndex = -1;
    $tempStart = 0;
    $minSizeOfSubString = infinity_integer;
    $globalCounter = 0;

    foreach($strSource as $key=>$searchChar){
        if(array_key_exists($searchChar,$strSourceCounter)){
            $strSourceCounter[$searchChar]+=1;
        }
        else{
            $strSourceCounter[$searchChar]=1;
        }

        if(
            array_key_exists($searchChar, $charToSearchCounter)
            && $strSourceCounter[$searchChar] <= $charToSearchCounter[$searchChar]){
            $globalCounter += 1;
        }


        if($globalCounter == count($charsToSearch)) {

            while(
                (array_key_exists($strSource[$tempStart],$charToSearchCounter) == false) ||
                $strSourceCounter[$strSource[$tempStart]] > $charToSearchCounter[$strSource[$tempStart]]
                ) {
                    if( (array_key_exists($strSource[$tempStart], $charToSearchCounter) == true) &&
                        $strSourceCounter[$strSource[$tempStart]] > $charToSearchCounter[$strSource[$tempStart]] ){
                        $strSourceCounter[$strSource[$tempStart]] -=1;
                    }  
                    $tempStart +=1;
            }

            $tempMinSize = $key - $tempStart + 1;
            if($minSizeOfSubString > $tempMinSize){
                $minSizeOfSubString = $tempMinSize;
                $globalStartIndex = $tempStart;
            }       
        }

    }

    return ($globalStartIndex>-1)? implode("",(array_slice($strSource, $globalStartIndex, $minSizeOfSubString))) : "";


    //$hashCharsToSearch = createHashArrayFromString($charsToSearch);
    //$hashStrSource = createHashArrayFromString($strSource);
    //print_r($hashCharsToSearch);
    //print_r($hashStrSource);
}


print_r (noIterate(["ahffaksfajeeubsne", "jefaa"]) );
