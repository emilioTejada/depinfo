<?php

namespace AppBundle\DataImport;

use AppBundle\Entity\UploadedFileUsers;
use Liuggio\ExcelBundle\Factory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserControlBundle\Repository\RolRepository;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use UserControlBundle\Entity\User;



/**
 * @DI\Service("app.xls_file_users_importer")
 */
class XlsFileUsersImporter extends Controller
{
//    private $factoryExcel;
//    private $handler_rol;
//    private $container;
//
//   public function __construct(Factory $factory, RolRepository $handler_rol)
//   {
//       $this->factoryExcel= $factory;
//       $this->handler_rol= $handler_rol;
//   }
//
//    public function setContainer(\Symfony\Component\DependencyInjection\ContainerInterface $container = null)
//    {
//        $this->container = $container;
//    }


    public function import(UploadedFileUsers $uploadedFileUsers){
//        $phpExcelObject = $this->factoryExcel->createPHPExcelObject($uploadedFile->getRealPath());
        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject($uploadedFileUsers->getData()->getRealPath());


        $user_sheet = $phpExcelObject->getSheetByName('ALUMNADO DEL CENTRO');
        $num_rows= $user_sheet->getHighestRow();
        for ($i=6;$i<9;$i++){
            if (!strcmp($user_sheet->getCellByColumnAndRow(1,$i)->getValue(),"Anulada")){
//            $rol_user = $this->handler_rol->findByName("Alumno");
                $rol_user = $this->get('repository.rol')->findByName("Alumno");
                $user = New User();
                $user->setRol($rol_user);

                $name_and_surname= $user_sheet->getCellByColumnAndRow(0,$i)->getValue();
                $name= explode(",",$name_and_surname)[1];
                $surname = explode(",",$name_and_surname)[1];
                $user->setName($name);
                $user->setSurname($surname);

                $user->setEmail($user_sheet->getCellByColumnAndRow(11,$i)->getValue());


                $data_course= $user_sheet->getCellByColumnAndRow(12,$i)->getValue();
                $curso= intval(substr($data_course, 0, 1));
                $data_ciclo= preg_match('/\(([\w ]+)\)/g',$data_course,$ciclo_name);
                $name_ciclo= $ciclo_name;
            }
        }
    }
}