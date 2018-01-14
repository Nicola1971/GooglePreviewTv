<?php
/*
 GooglePreviewTV — custom TV for SEo4Evo
 Version 14.01.18 by Nicola Lambathakis, http://www.tattoocms.it
*/

if (IN_MANAGER_MODE != 'true') {
 die('<h1>Error:</h1><p>Please use the MODx content manager instead of accessing this file directly.</p>');
}
// get global language
global $modx,$_lang;
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
$value = empty($row['value']) ? $row['default_text'] : $row['value'];
$rid = $row['id'];

//title
$pagetitle = $modx->documentObject['pagetitle'];
$CTitle = $modx->getTemplateVarOutput('CustomTitle',$id);
$Custom = $CTitle['CustomTitle'];

if(!$Custom == ""){
$MetaTitle = "$preTitle$Custom$postTitle";
} else {
      $MetaTitle = "$preTitle$pagetitle$postTitle";
   }
// *** Meta Description ***
$MetaDescriptionTv = isset($MetaDescriptionTv) ? $MetaDescriptionTv : 'MetaDescription';
$dyndesc = $modx->runSnippet(
        "DynamicDescription",
        array(
            "descriptionTV" => $MetaDescriptionTv,
			"maxWordCount=" => "25"
        )
);
//url
$url = $modx->makeUrl($id, '', '', 'full');

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
  <span class=\"s-titl\">$MetaTitle</span>
  <span class=\"s-url\">$url</span>
  <span class=\"s-desc\">$dyndesc.</span>
</div>
</div>";  

echo $output;
?>
