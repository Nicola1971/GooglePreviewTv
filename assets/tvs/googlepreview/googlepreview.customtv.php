<?php
/*
 GooglePreviewTV — custom TV for SEo4Evo
 Version 15.01.18 by Nicola Lambathakis, http://www.tattoocms.it
*/

if (IN_MANAGER_MODE != 'true') {
 die('<h1>Error:</h1><p>Please use the MODx content manager instead of accessing this file directly.</p>');
}
// get global language
global $modx,$_lang;
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
$value = empty($row['value']) ? $row['default_text'] : $row['value'];
$rid = $row['id'];
$site_name = $modx->config['site_name'];

// Manual configuration of Seo4Evo params
$MetaDescriptionTv = isset($MetaDescriptionTv) ? $MetaDescriptionTv : 'MetaDescription';
//$preTitle = "$site_name | ";
$postTitle = " | $site_name";

//Get the title
$pagetitle = $modx->documentObject['pagetitle'];
$CTitle = $modx->getTemplateVarOutput('CustomTitle',$id);
$Custom = $CTitle['CustomTitle'];
//check custoom title tv
if(!$Custom == ""){
$MetaTitle = "$preTitle$Custom$postTitle";
} else {
      $MetaTitle = "$preTitle$pagetitle$postTitle";
   }
$max_length = '70';
if (strlen($MetaTitle) > $max_length) {
$Title = substr($MetaTitle, 0, $max_length);
}
else {$Title = $MetaTitle;}

// Get Meta Description ***
$dyndesc = $modx->runSnippet(
        "DynamicDescription",
        array(
            "descriptionTV" => $MetaDescriptionTv,
			"maxWordCount=" => "25"
        )
);
//Get the url
$url = $modx->makeUrl($id, '', '', 'full');
//output Preview Tv
$output .="
<div>
<input type='text' style=\"display:none;\"  id=\"tv$rid\" name=\"tv$rid\" value=\"tv$rid\" />
<style>
.s-google{background:#fff; width:100%; font-family:arial,sans-serif; color:#545454; line-height:1.4; word-wrap:break-word; text-align:left; font-weight:normal; padding:15px; -webkit-box-shadow:0 0 6px 0 rgba(0,0,0,0.1); -moz-box-shadow:0 0 6px 0 rgba(0,0,0,0.1); box-shadow:0 0 6px 0 rgba(0,0,0,0.1);}
.s-google span{display:block;}
.s-titl{color:#1a0dab; white-space:nowrap; font-size:18px; line-height:1.5; font-weight:normal; text-decoration:none;}
.s-url{color:#006621; font-style:normal; font-size:14px; line-height:1.5; white-space:nowrap;}
.s-desc{font-size:13px;}
</style>
<div class=\"s-google\">
  <span class=\"s-titl\">$Title</span>
  <span class=\"s-url\">$url</span>
  <span class=\"s-desc\">$dyndesc.</span>
</div>
</div>";  

echo $output;
?>
