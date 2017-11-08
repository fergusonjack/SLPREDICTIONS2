<?php
/** Include PHPExcel */
require_once dirname(__FILE__) . '/ExcelPhp/PHPExcel.php';
require_once dirname(__FILE__) . '/ExcelPhp/PHPExcel/IOFactory.php';

if (!file_exists("templateE.xlsx")) {
        exit();
}

    // Create new PHPExcel object
    $objPHPExcel = PHPExcel_IOFactory::load("templateE.xlsx");
    // Set document properties
    $objPHPExcel->getProperties()->setCreator("SLFORECASTER")
        ->setLastModifiedBy("SLFORECASTER")
        ->setTitle("FORECASTER")
        ->setSubject("FORECASTER")
        ->setDescription("Student Loan forecaster")
        ->setKeywords("SL")
        ->setCategory("Result file");


    /** setting excel documents */
if (!(empty($_GET["total"]))){

    $objPHPExcel->getActiveSheet()->setCellValue('B2', preg_replace("/[^0-9]/" , "" , $_GET["total"]));
    $objPHPExcel->getActiveSheet()->setCellValue('B3', preg_replace("/[^0-9]/" , "" , $_GET["RPI"]) . "%");
    $objPHPExcel->getActiveSheet()->setCellValue('B4', preg_replace("/[^0-9]/" , "" , $_GET["margin"]) . "%");
    $objPHPExcel->getActiveSheet()->setCellValue('B5', preg_replace("/[^0-9]/" , "" , $_GET["payinf"]) . "%");

    $objPHPExcel->getActiveSheet()->setCellValue('E6', preg_replace("/[^0-9]/" , "" , $_GET["total"]));
    $objPHPExcel->getActiveSheet()->setCellValue('L2', preg_replace("/[^0-9]/" , "" , $_GET["repLim"]));
    $objPHPExcel->getActiveSheet()->setCellValue('L3', preg_replace("/[^0-9]/" , "" , $_GET["thresInf"]) . "%");
    $objPHPExcel->getActiveSheet()->setCellValue('L4', preg_replace("/[^0-9]/" , "" , $_GET["repaymentRate"]) . "%");
}

//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//$objWriter->save("exF/" .  preg_replace("/[^0-9]/" , "" , $_GET["IDNUM"]) . ".xlsx");

// We'll be outputting an excel file
header('Content-type: application/vnd.ms-excel');

// It will be called file.xls
header('Content-Disposition: attachment; filename="file.xls"');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save("exF/" .  preg_replace("/[^0-9]/" , "" , $_GET["IDNUM"]) . ".xlsx");

?>