<?php

define("infinity_integer", 100000000000000);

function noIterate($strArr)
{
    $strSource = str_split($strArr[0]);
    $charsToSearch = str_split($strArr[1]);

    $strSourceCounter = [];
    $charToSearchCounter = [];

    // Get first count of  subString 
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

    // Iterate over big string
    foreach($strSource as $key=>$searchChar){
        if(array_key_exists($searchChar,$strSourceCounter)){
            $strSourceCounter[$searchChar]+=1; // Increment counter
        }
        else{
            $strSourceCounter[$searchChar]=1; // Initialize
        }

        // Check if char is funded, and added 1 to global counter
        if(
            array_key_exists($searchChar, $charToSearchCounter)
            && $strSourceCounter[$searchChar] <= $charToSearchCounter[$searchChar]){
            $globalCounter += 1;
        }

        // If globalCounter is equal that length of chars to search
        if($globalCounter == count($charsToSearch)) {

            while(
                (array_key_exists($strSource[$tempStart],$charToSearchCounter) == false) ||
                $strSourceCounter[$strSource[$tempStart]] > $charToSearchCounter[$strSource[$tempStart]]
                ) {
                    // check if char is in the first counter array, reduce counter until it is the minimun necesary
                    if( (array_key_exists($strSource[$tempStart], $charToSearchCounter)) &&
                        $strSourceCounter[$strSource[$tempStart]] > $charToSearchCounter[$strSource[$tempStart]] ){
                        $strSourceCounter[$strSource[$tempStart]] -=1;
                    }  
                    // go to next char of source
                    $tempStart +=1;
            }

            // store index and size if is the least 
            $tempMinSize = $key - $tempStart + 1;
            if($minSizeOfSubString > $tempMinSize){
                $minSizeOfSubString = $tempMinSize;
                $globalStartIndex = $tempStart;
            }       
        }
    }
    // Concatening array of chars if substring was found
    return ($globalStartIndex>-1)? implode("",(array_slice($strSource, $globalStartIndex, $minSizeOfSubString))) : "";
}


print_r (noIterate(["ahffaksfajeeubsne", "jefaa"]) );
