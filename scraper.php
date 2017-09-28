<?
// This is a template for a PHP scraper on morph.io (https://morph.io)
// including some code snippets below that you should find helpful
//This scrapper is for http://www.commonlii.org Saving three feilds in database
require 'scraperwiki.php';
require 'scraperwiki/simple_html_dom.php';
//5369780
for($page = 0; $page < 20; $page+=20)
{
  
  echo "$page\n";

$url  = 'http://www.commonlii.org/cgi-bin/sinosrch.cgi?query=a;results=20;submit=Search;rank=on;callback=on;method=auto;meta=%2Fcommonlii;lii=CommonLII;offset='.$page;
  $NEWLINK = file_get_html($url);
  sleep(20);
  if($NEWLINK){
foreach($NEWLINK->find("//*[@id='view']/ol/li/p")as $element)
{
  $links = $element->find("a",0)->plaintext;
  $name = $element->find("a",0)->href;
 
 $record = array( 'pagelink' => $url, 'casename' => $name ,'detailpagelink' => $links );
  
 scraperwiki::save(array('pagelink','casename','detailpagelink'), $record);
 
 
} 
   sleep(5);

  }

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
