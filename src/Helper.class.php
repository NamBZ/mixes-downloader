<?php
function convertSeconds(int $seconds): string {
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds % 3600) / 60);
    $remainingSeconds = $seconds % 60;

    $hourString = $hours > 0 ? "{$hours}h" . ($hours > 1 ? '' : '') : '';
    $minuteString = $minutes > 0 ? "{$minutes}m" . ($minutes > 1 ? '' : '') : '';
    $secondString = $remainingSeconds > 0 ? "{$remainingSeconds}s" . ($remainingSeconds > 1 ? '' : '') : '';

    if ($hours > 0) {
        return "{$hourString} " . ($minuteString ?: '0m') . ($secondString ? " {$secondString}" : '');
    } elseif ($minutes > 0) {
        return "{$minuteString}" . ($secondString ? " {$secondString}" : '');
    }

    return $secondString;
}

function getTimeAgo($p_Date) { 
    $v_Seconds = strtotime('now') - strtotime($p_Date); 

    $a_UnitLabels = array('year','month','week','day','hour','minute','second'); 

    $a_UnitValues = array( 
        floor($v_Seconds / 31536000), 
        floor(($v_Seconds % 31536000) / 2592000), 
        floor(($v_Seconds % 2592000) / 604800), 
        floor(($v_Seconds % 604800) / 86400), 
        floor(($v_Seconds % 86400) / 3600), 
        floor(($v_Seconds % 3600) / 60), 
        floor($v_Seconds % 60), 
    ); 

    $a_UnitPairs = array(); 

    for($i=0;$i<count($a_UnitLabels);$i++){ 

        $v_Str  = $a_UnitValues[$i]>0 ? $a_UnitValues[$i].' '.$a_UnitLabels[$i] : ''; 

        $v_Str .= $a_UnitValues[$i]>1 ? 's' : ''; 

        if($v_Str!='') $a_UnitPairs[] = $v_Str; 
    } 

    $v_ReturnStr = $a_UnitPairs[0].' ago'; 

    return $v_ReturnStr; 
}


function abbreviateNumber($value) {
    $newValue = $value;
    if ($value >= 1000) {
        $suffixes = ["", "k", "m", "b", "t"];
        $suffixNum = floor(strlen((string)$value) / 3);
        $shortValue = '';
        for ($precision = 2; $precision >= 1; $precision--) {
            $shortValue = floatval($suffixNum != 0 ? ($value / pow(1000, $suffixNum)) : $value);
            $shortValue = round($shortValue, $precision);
            $dotLessShortValue = preg_replace('/[^a-zA-Z 0-9]+/', '', (string)$shortValue);
            if (strlen($dotLessShortValue) <= 2) { break; }
        }
        if ($shortValue % 1 != 0) $shortValue = number_format($shortValue, 1);
        $newValue = $shortValue . $suffixes[$suffixNum];
    }
    return $newValue;
}
