<?
// This is a template for a PHP scraper on morph.io (https://morph.io)
// including some code snippets below that you should find helpful

require 'scraperwiki.php';
require 'scraperwiki/simple_html_dom.php';
for($page = 20; $page < 40; $page+=20)
{
$url  = 'http://www.commonlii.org/cgi-bin/sinosrch.cgi?query=a;results=20;submit=Search;rank=on;callback=on;method=auto;meta=%2Fcommonlii;lii=CommonLII;offset='.$page;
 $NEWLINK = file_get_html($url);
  
  
foreach($NEWLINK->find("//*[@id='view']/ol/li/p")as $element)
{
  $links = $element->find("a",0)->plaintext;
 echo "$links \n"
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
