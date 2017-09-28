<?
// This is a template for a PHP scraper on morph.io (https://morph.io)
// including some code snippets below that you should find helpful

require 'scraperwiki.php';
require 'scraperwiki/simple_html_dom.php';
for($page = 0; $page < 150; $page+=50)
{
  $NEWLINK = 'http://www.worldlii.org/cgi-bin/sinosrch.cgi?method=auto;meta=%2Fworldlii;mask_path=;mask_world=;query=a;results=50;submit=Search;rank=on;callback=off;legisopt=;view=relevance;offset='.$page;
	     $cHeadres = array(
      'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
      'Accept-Language: en-US,en;q=0.5',
      'Connection: Keep-Alive',
      'Pragma: no-cache',
      'Cache-Control: no-cache'
     );

 $MyWebsite = $NEWLINK;

 function dlPage($href) {
  global $cHeadres;

  $ch = curl_init();
  if($ch){
   curl_setopt($ch, CURLOPT_URL, $href);
   curl_setopt($ch, CURLOPT_HTTPHEADER, $cHeadres);
   curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
   curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
   curl_setopt($ch, CURLOPT_HEADER, false);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
   curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)");
   $str = curl_exec($ch);
   curl_close($ch);

   $dom = new simple_html_dom();
   $dom->load($str);
   return $dom;
  }
 }

 $maincode = dlPage($MyWebsite);
 echo $maincode;
 

 
 

}


//
// // Read in a page
// $html = scraperwiki::scrape("http://foo.com");
//
// // Find something on the page using css selectors
// $dom = new simple_html_dom();
// $dom->load($html);
// print_r($dom->find("table.list"));
//
// // Write out to the sqlite database using scraperwiki library
// scraperwiki::save_sqlite(array('name'), array('name' => 'susan', 'occupation' => 'software developer'));
//
// // An arbitrary query against the database
// scraperwiki::select("* from data where 'name'='peter'")

// You don't have to do things with the ScraperWiki library.
// You can use whatever libraries you want: https://morph.io/documentation/php
// All that matters is that your final data is written to an SQLite database
// called "data.sqlite" in the current working directory which has at least a table
// called "data".
?>
