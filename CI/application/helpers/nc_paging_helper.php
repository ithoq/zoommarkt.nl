<?php 	
    function displayPaging($currentPage, $nrNextPages, $nrOfPages,$pageLimit)
    {
        // max aantal pages is afhankelijk van aantal items per page
        // er is en max gezet van 10.000 items ( sphinx heeft max 2500 items)
        // bij 10 items per page is max aantal pages dus 100
        // bij 15 items per page is max aantal pages dus 66
        // etc.

        $addToUrl ='';
        $paging = array();
        $maxpages = intval(10000/$pageLimit);
        $nrOfPages = $nrOfPages > $maxpages ? $maxpages : $nrOfPages;

        $lastPage =  $nrOfPages;
        $prevPage = $currentPage > 1 ? ($currentPage - 1) : 0;
        $minShow = "";
        $maxShow = "";
        
        $afhalen = floor($nrNextPages/2);
        $bijstop = 0;
        $afstart = 0;
        if(($currentPage - $afhalen) > 0) {
            $start = ($currentPage - $afhalen);
        } else {
            $start = 1;
            $bijstop = $afhalen - ($currentPage - 1);
        }
       
        if (($currentPage + $afhalen) < $lastPage) {
            $stop = ($currentPage + $afhalen) + $bijstop;
        } else {
            $stop = $lastPage;
            $afstart = $afhalen - ($lastPage - $currentPage);
        }
		if ($stop > $nrOfPages){
			$stop = $nrOfPages;
		}
        if($afstart> 0 && ($start - $afstart) > 0) 
        {
            $start = $start - $afstart;
        }       
  		
        echo '<ul class="page inline">';
        if($prevPage > 0) 
        {
           echo "<li> <a rel='nofollow' href='?page=" . $prevPage . $addToUrl . "'>Vorige</a> </li>\n";
        } 
		if($start > 2) {
    		echo "<li> <a rel='nofollow' href='?page=1'>1</a> </li>";
    		echo "...";
    	}
    	
    	for($i=$start;$i<=$stop;$i++) {
                $paging[$i] = ($i != $currentPage) ? "<li> <a rel='nofollow' href='?page=" . $i . $addToUrl . "'>" : " <li><strong> ";
                $paging[$i].= $i;
                $paging[$i].=  ($i != $currentPage) ? "</a> </li>" : "</strong> </li>";            
        }
        echo implode("",$paging);
         

	    if(($stop) < $lastPage ) {
            echo "...";
	        echo "<li> <a rel='nofollow' href='?page=" . $lastPage  . $addToUrl . "'>".$lastPage."</a> </li>";
        }
            
        if($currentPage < $lastPage) {
		  echo "<li> <a  rel='nofollow' href='?page=" . ($currentPage+1) . $addToUrl . "'>Volgende</a> </li>";
	    }
		 echo "</ul>\n";
    }
