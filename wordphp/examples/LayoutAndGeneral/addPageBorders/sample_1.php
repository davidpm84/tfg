<?php
// add page borders

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocx();

$options = array(
	'borderWidth' => 12,
	'borderTopColor' => 'FF0000',
);
$docx->addPageBorders($options);
$text = 'This is just a chunk of text that we will repeat couple of times to fill up some space. ';
$text .= $text;
$docx->addText($text);
$docx->addText('Another chunk of text');
$docx->addText($text);

$docx->createDocx('example_addPageBorders_1');