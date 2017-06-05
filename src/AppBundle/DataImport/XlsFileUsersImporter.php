<?php

namespace AppBundle\DataImport;

use AppBundle\Entity\UploadedFileUsers;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("app.xls_file_users_importer")
 */
class XlsFileUsersImporter
{
    public function import(UploadedFileUsers $uploadedFileUsers){

//        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject($uploadedFileUsers->getData());

    }
}