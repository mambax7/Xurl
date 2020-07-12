<?php 
$header= <<<ENDH

;//  ------------------------------------------------------------------------ //
;//  Author: Designburo.nl (sales@designburo.nl)                              //
;//  http://www.designburo.nl                                                 //
;//  Project: Xurl                                                            //
;//  Copyright (c) 2009 by Designburo.nl This material may be distributed     //
;//  only subject to the terms and conditions set forth in the                //
;//  Open Public License, v1.0 or later.                                      //
;//  https://fedoraproject.org/wiki/Licensing/Open_Public_License             //
;//  ------------------------------------------------------------------------ //


ENDH;

if (!function_exists('write_ini_file')) { 
    function write_ini_file($assoc_arr, $path, $has_sections=FALSE) { 
		global $header;
        $content = ""; 

        if ($has_sections) { 
            foreach ($assoc_arr as $key=>$elem) { 
                $content .= "[".$key."]\n"; 
                foreach ($elem as $key2=>$elem2) 
                { 
                    if(is_array($elem2)) 
                    { 
                        for($i=0;$i<count($elem2);$i++) 
                        { 
                            $content .= $key2."[] = \"".$elem2[$i]."\"\n"; 
                        } 
                    } 
                    else if($elem2=="") $content .= $key2." = \n"; 
                    else $content .= $key2." = \"".$elem2."\"\n"; 
                } 
            } 
        } 
        else { 
            foreach ($assoc_arr as $key=>$elem) { 
                if(is_array($elem)) 
                { 
                    for($i=0;$i<count($elem);$i++) 
                    { 
                        $content .= $key2."[] = \"".$elem[$i]."\"\n"; 
                    } 
                } 
                else if($elem=="") $content .= $key2." = \n"; 
                else $content .= $key2." = \"".$elem."\"\n"; 
            } 
        } 
		$content = $header.$content;
		
        if (!$handle = fopen($path, 'w')) { 
            return false; 
        } 
        if (!fwrite($handle, $content)) { 
            return false; 
        } 
        fclose($handle); 
        return true; 
    } 
} 
?> 