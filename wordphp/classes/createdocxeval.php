$this->_phpdocxconfig = PhpdocxUtilities::parseConfig(); 
   $this->_docxTemplate = false; 
   if ($baseTemplatePath == 'docm') { 
    $this->_baseTemplatePath = PHPDOCX_BASE_FOLDER . 'phpdocxBaseTemplate.docm'; 
    $this->_docm = true; 
    $this->_defaultTemplate = true; 
    $this->_extension = 'docm'; 
} else if ($baseTemplatePath == 'docx') { 
    $this->_baseTemplatePath = PHPDOCX_BASE_FOLDER . 'phpdocxBaseTemplate.docx'; 
    $this->_docm = false; 
    $this->_defaultTemplate = true; 
    $this->_extension = 'docx'; 
} else if (!empty($docxTemplatePath)) { 
    $this->_defaultTemplate = false; 
    $this->_docxTemplate = true; 
    $this->_baseTemplatePath = $docxTemplatePath; 
    if ($docxTemplatePath instanceof DOCXStructure) { 
        $this->_docm = false; 
    } else { 
        $extension = strtolower(pathinfo($this->_baseTemplatePath, PATHINFO_EXTENSION)); 
        $this->_extension = $extension; 
        if ($extension == 'docm') { 
            $this->_docm = true; 
        } else if ($extension == 'docx') {
             $this->_docm = false; 
            } else { 
                PhpdocxLogger::logger('Invalid template extension', 'fatal'); 
            } 
        } 
    } else { 
        if ($baseTemplatePath == PHPDOCX_BASE_TEMPLATE) {
             $this->_defaultTemplate = true; 
            } else { 
                $this->_defaultTemplate = false; 
            } $this->_baseTemplatePath = $baseTemplatePath;
             $extension = strtolower(pathinfo($this->_baseTemplatePath, PATHINFO_EXTENSION));
             $this->_extension = $extension; 
             if ($extension == 'docm') { 
                $this->_docm = true; 
            } else if ($extension == 'docx') { 
                $this->_docm = false; 
            } else { 
                PhpdocxLogger::logger('Invalid base template extension', 'fatal'); 
            } 
        } 
        if (file_exists(dirname(__FILE__) . '/DOCXStructureTemplate.php')) { 
            if (PHPDOCX_BASE_TEMPLATE == PHPDOCX_BASE_FOLDER . 'phpdocxBaseTemplate.docx' && empty($docxTemplatePath) && !$this->_docm) { 
                $templateStructure = new DOCXStructureTemplate(); 
                $this->_zipDocx = $templateStructure->getStructure(); 
            } elseif ($docxTemplatePath instanceof DOCXStructure) { 
                $this->_zipDocx = $docxTemplatePath; 
            } else { 
               $this->_zipDocx = new DOCXStructure(); 
               $this->_zipDocx->parseDocx($this->_baseTemplatePath); 
            } 
        } else { 
            $this->_zipDocx = new DOCXStructure(); 
            $this->_zipDocx->parseDocx($this->_baseTemplatePath); 
        } 
        $this->_background = ''; 
         w:background OOXML element $this->_backgroundColor = 'FFFFFF'; 
         docx background color self::$bookmarksIds = array(); 
         self::$captionsIds = array(); 
         $this->_idWords = array(); 
         self::$intIdWord = rand(9999999, 99999999); 
         self::$_encodeUTF = 0; 
         $this->_language = 'en-US'; 
         $this->_markAsFinal = 0; 
         $this->_repairMode = null; 
         $this->_relsRelsC = ''; 
         $this->_relsRelsT = ''; 
         $this->_contentTypeC = ''; 
         $this->_contentTypeT = null; 
         $this->_defaultFont = ''; 
         self::$baseCSSHTML = null; 
         $this->_macro = 0; 
         $this->_modifiedDocxProperties = false; 
         $this->_modifiedHeadersFooters= array(); 
         $this->_relsHeader = array(); 
         $this->_relsFooter = array(); 
         $this->_parsedStyles = array(); 
         $this->_parsedStylesChart = array(); 
         self::$_relsHeaderFooterImage = array(); 
         self::$_relsHeaderFooterExternalImage = array(); 
         self::$_relsHeaderFooterLink = array(); 
         self::$_relsNotesExternalImage = array(); 
         self::$_relsNotesImage = array(); 
         self::$_relsNotesLink = array(); 
         $this->_sectPr = null; 
         $this->_tempDocumentDOM = null; 
         $this->_tempFileXLSX = array(); 
         $this->_uniqid = 'phpdocx_' . uniqid(mt_rand(999, 9999)); 
         $this->_wordCommentsT = new DOMDocument(); 
         $this->_wordCommentsExtendedT = new DOMDocument(); 
         $this->_wordCommentsRelsT = new DOMDocument(); 
         $this->_wordDocumentPeople = new DOMDocument(); 
         $this->_wordDocumentT = ''; 
         $this->_wordDocumentC = ''; 
         $this->_wordDocumentStyles = ''; 
         $this->_wordEndnotesT = new DOMDocument(); 
         $this->_wordEndnotesRelsT = new DOMDocument(); 
         $this->_wordFooterC = array(); 
         $this->_wordFooterT = array(); 
         $this->_wordFootnotesT = new DOMDocument(); 
         $this->_wordFootnotesRelsT = new DOMDocument(); 
         $this->_wordHeaderC = array(); 
         $this->_wordHeaderT = array(); 
         $this->_wordNumberingT; 
         $this->_wordRelsDocumentRelsT = null; 
         $this->_wordSettingsT = ''; 
         $this->_wordStylesT = null; 
         self::$customLists = array(); 
         self::$insertNameSpaces = array(); 
         self::$nameSpaces = array(); 
         $baseTemplateDocumentT = $this->getFromZip('word/document.xml');
         w:background element if it exists $bodySplit = explode('', $baseTemplateDocumentT); 
         $tempDocumentXMLElement = $bodySplit[0]; 
         $backgroundSplit = explode('_documentXMLElement = $backgroundSplit[0]; if (!empty($backgroundSplit[1])) { $this->_background = 'loadXML($baseTemplateDocumentT); if (PHP_VERSION_ID < 80000) { libxml_disable_entity_loader($optionEntityLoader); } 
         $docXpath = new DOMXPath($baseDocument); 
         $docXpath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main'); 
         $NSQuery = '//w:document/namespace::*'; 
         $xmlnsNodes = $docXpath->query($NSQuery); 
         foreach ($xmlnsNodes as $node) { 
            self::$nameSpaces[$node->nodeName] = $node->nodeValue; 
        } 
        $documentQuery = '//w:document'; 
        $documentElement = $docXpath->query($documentQuery)->item(0); 
        foreach ($documentElement->attributes as $attribute_name => $attribute_node) { 
            self::$nameSpaces[$attribute_name] = $attribute_node->nodeValue; } 
            if (!$this->_docxTemplate) { 
                $queryDoc = '//w:body/w:sdt'; 
                $docNodes = $docXpath->query($queryDoc); 
                if ($docNodes->length > 0) { 
                    if ($docNodes->item(0)->nodeName == 'w:sdt') { 
                        $tempDoc = new DOMDocument(); 
                        $sdt = $tempDoc->importNode($docNodes->item(0), true);
                        $newNode = $tempDoc->appendChild($sdt); 
                        $frontPage = $tempDoc->saveXML($newNode); 
                        $this->_wordDocumentC .= $frontPage; } } } 
                        else { 
                            $queryBody = '//w:body';
                            $bodyNodes = $docXpath->query($queryBody); 
                            $bodyNode = $bodyNodes->item(0); 
                            $bodyChilds = $bodyNode->childNodes;
                             foreach ($bodyChilds as $node) { 
                                if ($node->nodeName != 'w:sectPr') { 
                                    $this->_wordDocumentC .= $baseDocument->saveXML($node); } } } 
                                    $this->_tempDocumentDOM = $this->getDOMDocx(); $querySectPr = '//w:body/w:sectPr'; $sectPrNodes = $docXpath->query($querySectPr); 
                                    $sectPr = $sectPrNodes->item(0); 
                                    $this->_sectPr = new DOMDocument();
                                     $sectNode = $this->_sectPr->importNode($sectPr, true); 
                                     $this->_sectPr->appendChild($sectNode); 
                                     $this->_contentTypeT = $this->getFromZip('[Content_Types].xml', 'DOMDocument'); 
                                     $this->generateDEFAULT('gif', 'image/gif'); $this->generateDEFAULT('jpg', 'image/jpg');
                                      $this->generateDEFAULT('png', 'image/png'); $this->generateDEFAULT('jpeg', 'image/jpeg'); 
                                      $this->generateDEFAULT('bmp', 'image/bmp'); 
                                      $this->_wordRelsDocumentRelsT = $this->getFromZip('word/_rels/document.xml.rels', 'DOMDocument'); 
                                      $relationships = $this->_wordRelsDocumentRelsT->getElementsByTagName('Relationship'); 
                                      $this->_wordStylesT = $this->getFromZip('word/styles.xml', 'DOMDocument');
                                      $this->_wordSettingsT = $this->getFromZip('word/settings.xml', 'DOMDocument');
                                      if (!$this->_defaultTemplate || $this->_docxTemplate) { 
                                        $this->importStyles(PHPDOCX_BASE_TEMPLATE, 'PHPDOCXStyles'); } 
                                        $this->_wordNumberingT = $this->getFromZip('word/numbering.xml'); 
                                        $numRef = rand(999, 30000); 
                                        self::$numUL = $numRef; self::$numOL = $numRef + 1; 
                                        if ($this->_wordNumberingT !== false) { 
                                            $this->_wordNumberingT = $this->importSingleNumbering($this->_wordNumberingT, OOXMLResources::$unorderedListStyle, self::$numUL); 
                                            $this->_wordNumberingT = $this->importSingleNumbering($this->_wordNumberingT, OOXMLResources::$orderedListStyle, self::$numOL); } else {
                                                 $this->_wordNumberingT = $this->generateBaseWordNumbering(); 
                                                 $this->_wordNumberingT = $this->importSingleNumbering($this->_wordNumberingT, OOXMLResources::$unorderedListStyle, self::$numUL); 
                                                 $this->_wordNumberingT = $this->importSingleNumbering($this->_wordNumberingT, OOXMLResources::$orderedListStyle, self::$numOL); 
                                                 Override $this->generateRELATIONSHIP( 'rId' . rand(99999999, 999999999), 'numbering', 'numbering.xml' ); 
                                                 $this->generateOVERRIDE('/word/numbering.xml', 'application/vnd.openxmlformats-officedocument.wordprocessingml.numbering+xml'); } 
                                                 if ($this->getFromZip('word/footnotes.xml') === false) { 
                                                    if (PHP_VERSION_ID < 80000) { $optionEntityLoader = libxml_disable_entity_loader(true); }
                                                     $this->_wordFootnotesT->loadXML(OOXMLResources::$footnotesXML); 
                                                     if (PHP_VERSION_ID < 80000) { libxml_disable_entity_loader($optionEntityLoader); }
                                                     Override $this->generateRELATIONSHIP( 'rId' . rand(99999999, 999999999), 'footnotes', 'footnotes.xml' );
                                                     $this->generateOVERRIDE('/word/footnotes.xml', 'application/vnd.openxmlformats-officedocument.wordprocessingml.footnotes+xml'); } else { 
                                                        $this->_wordFootnotesT = $this->getFromZip('word/footnotes.xml', 'DOMDocument'); } 
                                                        if ($this->getFromZip('word/_rels/footnotes.xml.rels') === false) { 
                                                            if (PHP_VERSION_ID < 80000) { $optionEntityLoader = libxml_disable_entity_loader(true); } 
                                                            $this->_wordFootnotesRelsT->loadXML(OOXMLResources::$notesXMLRels); 
                                                            if (PHP_VERSION_ID < 80000) { libxml_disable_entity_loader($optionEntityLoader); } } else { 
                                                                $this->_wordFootnotesRelsT = $this->getFromZip('word/_rels/footnotes.xml.rels', 'DOMDocument'); } 
                                                                if ($this->getFromZip('word/endnotes.xml') === false) { if (PHP_VERSION_ID < 80000) { 
                                                                    $optionEntityLoader = libxml_disable_entity_loader(true); } 
                                                                    $this->_wordEndnotesT->loadXML(OOXMLResources::$endnotesXML); 
                                                                    if (PHP_VERSION_ID < 80000) { libxml_disable_entity_loader($optionEntityLoader); } 
                                                                    Override $this->generateRELATIONSHIP( 'rId' . rand(99999999, 999999999), 'endnotes', 'endnotes.xml' ); 
                                                                    $this->generateOVERRIDE('/word/endnotes.xml', 'application/vnd.openxmlformats-officedocument.wordprocessingml.endnotes+xml'); } else { 
                                                                        $this->_wordEndnotesT = $this->getFromZip('word/endnotes.xml', 'DOMDocument'); } 
                                                                        if ($this->getFromZip('word/_rels/endnotes.xml.rels') === false) { if (PHP_VERSION_ID < 80000) { 
                                                                            $optionEntityLoader = libxml_disable_entity_loader(true); } 
                                                                            $this->_wordEndnotesRelsT->loadXML(OOXMLResources::$notesXMLRels); if (PHP_VERSION_ID < 80000) { libxml_disable_entity_loader($optionEntityLoader); } } else {
                                                                                $this->_wordEndnotesRelsT = $this->getFromZip('word/_rels/endnotes.xml.rels', 'DOMDocument'); } 
                                                                                if ($this->getFromZip('word/comments.xml') === false) { if (PHP_VERSION_ID < 80000) { $optionEntityLoader = libxml_disable_entity_loader(true); } 
                                                                                $this->_wordCommentsT->loadXML(OOXMLResources::$commentsXML); if (PHP_VERSION_ID < 80000) { libxml_disable_entity_loader($optionEntityLoader); } 
                                                                                Override $this->generateRELATIONSHIP( 'rId' . rand(99999999, 999999999), 'comments', 'comments.xml' ); 
                                                                                $this->generateOVERRIDE('/word/comments.xml', 'application/vnd.openxmlformats-officedocument.wordprocessingml.comments+xml'); } else { 
                                                                                    $this->_wordCommentsT = $this->getFromZip('word/comments.xml', 'DOMDocument'); } if ($this->getFromZip('word/_rels/comments.xml.rels') === false) { 
                                                                                        if (PHP_VERSION_ID < 80000) { $optionEntityLoader = libxml_disable_entity_loader(true); } $this->_wordCommentsRelsT->loadXML(OOXMLResources::$notesXMLRels); 
                                                                                        if (PHP_VERSION_ID < 80000) { libxml_disable_entity_loader($optionEntityLoader); } } else { $this->_wordCommentsRelsT = $this->getFromZip('word/_rels/comments.xml.rels', 'DOMDocument'); } 
                                                                                        if ($this->getFromZip('word/commentsExtended.xml') === false) {
                                                                                             if (PHP_VERSION_ID < 80000) { $optionEntityLoader = libxml_disable_entity_loader(true); } 
                                                                                             $this->_wordCommentsExtendedT->loadXML(OOXMLResources::$commentsExtendedXML); if (PHP_VERSION_ID < 80000) { libxml_disable_entity_loader($optionEntityLoader); } 
                                                                                             Override $this->generateRELATIONSHIP( 'rId' . rand(99999999, 999999999), 'commentsExtended', 'commentsExtended.xml' ); 
                                                                                             $this->generateOVERRIDE('/word/commentsExtended.xml', 'application/vnd.openxmlformats-officedocument.wordprocessingml.commentsExtended+xml'); } else { 
                                                                                                $this->_wordCommentsExtendedT = $this->getFromZip('word/commentsExtended.xml', 'DOMDocument'); } 
                                                                                                if (file_exists(dirname(__FILE__) . '/Tracking.php')) { 
                                                                                                    if ($this->getFromZip('word/people.xml') === false) { if (PHP_VERSION_ID < 80000) { $optionEntityLoader = libxml_disable_entity_loader(true); } 
                                                                                                    $this->_wordDocumentPeople->loadXML(OOXMLResources::$peopleXML); if (PHP_VERSION_ID < 80000) { libxml_disable_entity_loader($optionEntityLoader); } 
                                                                                                    Override $this->generateRELATIONSHIP( 'rId' . rand(99999999, 999999999), 'people', 'people.xml' ); 
                                                                                                    $this->generateOVERRIDE('/word/people.xml', 'application/vnd.openxmlformats-officedocument.wordprocessingml.people+xml'); } else { 
                                                                                                        $this->_wordDocumentPeople = $this->getFromZip('word/people.xml', 'DOMDocument'); } } 
                                                                                                         if ($this->_defaultTemplate) { self::$numUL = 1; self::$numOL = rand(999, 30000); } else { if (!$this->_docxTemplate) { 
                                                                                                            $counter = $relationships->length - 1; for ($j = $counter; $j > -1; $j--) { $completeType = $relationships->item($j)->getAttribute('Type'); 
                                                                                                                $target = $relationships->item($j)->getAttribute('Target'); $tempArray = explode('/', $completeType); $type = array_pop($tempArray); 
                                                                                                                $arrayCleaner = array(); switch ($type) { case 'header': array_push($this->_relsHeader, $target); break; case 'footer': array_push($this->_relsFooter, $target); break; case 'chart': $this->_wordRelsDocumentRelsT->documentElement->removeChild($relationships->item($j)); break; case 'embeddings': $this->_wordRelsDocumentRelsT->documentElement->removeChild($relationships->item($j)); break; } } } else { 
                                                                                                                    $counter = $relationships->length - 1; for ($j = $counter; $j > -1; $j--) { $completeType = $relationships->item($j)->getAttribute('Type'); $target = $relationships->item($j)->getAttribute('Target'); $tempArray = explode('/', $completeType); $type = array_pop($tempArray); 
                                                                                                                        $arrayCleaner = array(); switch ($type) { case 'header': array_push($this->_relsHeader, $target); break; case 'footer': array_push($this->_relsFooter, $target); break; } } } } 
                                                                                                                        if (!$this->_docxTemplate) { $this->modifyPageLayout($this->_phpdocxconfig['settings']['paper_size']); $this->setLanguage($this->_phpdocxconfig['settings']['language']); } 
                                                                                                                         if (isset($this->_phpdocxconfig['settings']['bidi'])) { self::$bidi = $this->_phpdocxconfig['settings']['bidi']; } else { self::$bidi = false; } if (isset($this->_phpdocxconfig['settings']['rtl'])) { self::$rtl = $this->_phpdocxconfig['settings']['rtl']; } else { self::$rtl = false; } if (self::$bidi || self::$rtl) { $this->setRTL(array('bidi' => self::$bidi, 'rtl' => self::$rtl)); } 
                                                                                                                          if (isset($this->_phpdocxconfig['settings']['stream']) && (bool)$this->_phpdocxconfig['settings']['stream'] === true && file_exists(dirname(__FILE__) . '/ZipStream.php')) { self::$streamMode = true; } 
                                                                                                                          $message = ' '.str_rot13('Guvf qbphzrag unf orra trarengrq jvgu n').' '.str_rot13('gevny').' '.str_rot13('pbcl bs').' '.str_rot13('CUCQbpK').' . '.str_rot13('Cyrnfr').' , '.str_rot13('ivfvg').' '.str_rot13('gur').' HYPERLINK "'.str_rot13('uggc://jjj.cucqbpk.pbz').'" '.str_rot13('CUCQbpK jrofvgr').' '.str_rot13('gb ohl gur yvprafr gung orfg nqncgf gb lbhe arrqf').'. '; $this->addWordML($message);
    