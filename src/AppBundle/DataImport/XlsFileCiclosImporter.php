<?php

namespace AppBundle\DataImport;

use AppBundle\Entity\Ciclo;
use AppBundle\Entity\UploadedDataDto;
use Liuggio\ExcelBundle\Factory;


class XlsFileCiclosImporter
{
    private $factoryExcel;

   public function __construct(Factory $factory)
   {
       $this->factoryExcel= $factory;
   }

    public function import(UploadedDataDto $uploadedFileUsers){

        $ciclos_array = [];
        $phpExcelObject = $this->factoryExcel->createPHPExcelObject($uploadedFileUsers->getData()->getRealPath());
        $sheet_reader = $phpExcelObject->getSheetByName('ciclos');
        $num_rows= $sheet_reader->getHighestRow();
        for ($i=2;$i<$num_rows;$i++){
            $new_ciclo= new Ciclo();
            $new_ciclo->setGrado($sheet_reader->getCellByColumnAndRow(0,$i));
            $new_ciclo->setFamilia($sheet_reader->getCellByColumnAndRow(1,$i));
            $new_ciclo->setName($sheet_reader->getCellByColumnAndRow(2,$i));
            $new_ciclo->setPlan($sheet_reader->getCellByColumnAndRow(3,$i));

            array_push($ciclos_array, $new_ciclo);

        }
        return $ciclos_array;
    }
}