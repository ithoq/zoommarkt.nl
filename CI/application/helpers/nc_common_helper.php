<?php

function snippit($string = '', $length = 10, $end = '...'){
	$totallength = strlen($end) + $length; 
	$strout = (strlen($string) > $totallength) ? substr($string,0,$length).$end : $string;
	return $strout;
} 


function getImage( $image_name,$user_path,$width,$height ) {


    	    $image_path = 'image/output/'.$width.'_'.$height;
            
	    $userdirs = explode('/',$user_path);
            foreach ($userdirs as $userdir){
                $image_path =  $image_path . '/'.$userdir;
                if (!file_exists($image_path)) {
                    mkdir($image_path, DIR_WRITE_MODE, true);
                }
            }

            $image_src =  'uploads/' . $user_path. '/'. $image_name;
            $image_rsized =  $image_path .'/'. $image_name;
            if ( !file_exists( $image_rsized ) )
            {
                // load CI by ref. ( beter voor geheugen ) 
                $CI = & get_instance();
                // configureer 
                $config['image_library']    = 'gd2';
                $config['source_image']     = $image_src;
                $config['new_image']        = $image_rsized;
                $config['maintain_ratio']   = TRUE;
                $config['height']           = $height;
                $config['width']            = $width;
                $CI->image_lib->initialize( $config );
                $CI->image_lib->resize();
                $CI->image_lib->clear();

            }
	return  $image_rsized;
 }
 
function seoUrl($str){
		/** by Jonatas Urias B Teixeira	**/
		$a = array('/(à|á|â|ã|ä|å|æ)/','/(è|é|ê|ë)/','/(ì|í|î|ï)/','/(ð|ò|ó|ô|õ|ö|ø|œ)/','/(ù|ú|û|ü)/','/ç/','/þ/','/ñ/','/ß/','/(ý|ÿ)/','/(=|\+|\\\|\.|\_|\\n| |\(|\))/','/[^a-z0-9_\/ -]/s','/-{2,}/s');
		$b = array('a','e','i','o','u','c','d','n','ss','y','-','','-');
		return trim(preg_replace($a, $b, strtolower($str)),'-');
}
	
