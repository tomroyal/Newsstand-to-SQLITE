<?php	
// reads all Newsstand report files in the directory ./input/ and stores all subscriptions in the SQLITE db

class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('itunes.sqlite');
      }
   }
// end class

function fixdate($thedate){
	$parts = explode("/", $thedate);
	$fixed = $parts['2'].'-'.$parts['0'].'-'.$parts['1'];	
	return($fixed);	
};	

if ($handle2 = opendir('./input/')) {
    while (false !== ($entry = readdir($handle2))) {
		if ((strpos($entry,"txt")) != ""){ //only work on text files
			echo "\nProcessing ".$entry."\n";

			// start process

			$row = 0;
			$tempath = "./input/".$entry;
			if (($handle = fopen($tempath, "r")) !== FALSE) {
				
			// open db
			$db = new MyDB();
				if(!$db){
					echo $db->lastErrorMsg();
				} else {
					// echo "Opened database successfully\n";
				};
				
			    while (($data = fgetcsv($handle, 1000, "\t")) !== FALSE) {
			        $num = count($data);
			        if ($num == 20 OR $num == 21 OR $num = 23){ // checks it fits format of NDD files from over the years		
						if (($data[6] == "IAY")){
							// have a sub
							// insert into db
								$query = "INSERT INTO subs (provider, providercountry, sku, developer, title, version, producttypeidentifier, units, developerproceeds, customercurrency, countrycode, currencyofproceeds, appleidentifier, customerprice, promocode, parentidentifier, subscription, period, downloaddatepst, customeridentifier, reporttdatelocal, salereturn, category) VALUES (\"".$data[0]."\",\"".$data[1]."\",\"".$data[2]."\",\"".$data[3]."\",\"".$data[4]."\",\"".$data[5]."\",\"".$data[6]."\",\"".$data[7]."\",\"".$data[8]."\",\"".$data[9]."\",\"".$data[10]."\",\"".$data[11]."\",\"".$data[12]."\",\"".$data[13]."\",\"".$data[14]."\",\"".$data[15]."\",\"".$data[16]."\",\"".$data[17]."\",\"".fixdate($data[18])."\",\"".$data[19]."\",\"".fixdate($data[20])."\",\"".$data[21]."\",\"".$data[22]."\");";
						
							$ret = $db->exec($query);
								   if(!$ret){
									  echo $db->lastErrorMsg();
								   } else {
									  echo ".";
								   };   	
						$row++;		
						}; //sub
						
					}; // num = 20 or 21 or 23
					
			    } // while rows
				$db->close();
			    fclose($handle);
			} // file
			// end process
		};
    }
    closedir($handle2);
}
?>


