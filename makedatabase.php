<?php
	// creates a new sqlite database, and sets up the table
	
    if ($db = new SQLite3('itunes.sqlite')) {
		$db->exec('CREATE TABLE subs (id INTEGER PRIMARY KEY, provider text, providercountry text, sku text, developer text, title text, version text, producttypeidentifier text, units int, developerproceeds text, customercurrency text, countrycode text, currencyofproceeds text, appleidentifier text, customerprice text, promocode text, parentidentifier text, subscription text, period text, downloaddatepst text, customeridentifier int, reporttdatelocal text, salereturn text, category text);');
    } else {
        die($err);
    }
?>