<?php

namespace AppBundle\DataImport;

use AppBundle\Entity\UploadedDataDto;
use Liuggio\ExcelBundle\Factory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserControlBundle\Repository\RolRepository;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use UserControlBundle\Entity\User;



class XlsFileUsersImporter
{
    private $factoryExcel;
    private $handler_rol;

   public function __construct(Factory $factory, RolRepository $handler_rol)
   {
       $this->factoryExcel= $factory;
       $this->handler_rol= $handler_rol;
   }

    public function import(UploadedDataDto $uploadedFileUsers){
        $user_array = [];
        $phpExcelObject = $this->factoryExcel->createPHPExcelObject($uploadedFileUsers->getData()->getRealPath());
        $user_sheet = $phpExcelObject->getSheetByName('ALUMNADO DEL CENTRO');
        $num_rows= $user_sheet->getHighestRow();
        for ($i=6;$i<$num_rows;$i++){
            if (strcmp($user_sheet->getCellByColumnAndRow(1,$i)->getValue(),"Anulada")!=0){
                $rol_user = $this->handler_rol->findByName("Alumno")->getResult();
                $user = New User();
                $user->setRol($rol_user[0]);

                $name_and_surname= $user_sheet->getCellByColumnAndRow(0,$i)->getValue();
                if ($name_and_surname == null) break;
                $name= trim(explode(",",$name_and_surname)[1]);
                $surname = explode(",",$name_and_surname)[0];
                $user->setName($name);
                $user->setSurname($surname);

                $username= strtolower(substr($name, 0, 1).$this->normaliza(explode(" ",$surname)[0]));
                $user->setUsername($username);
                $user->setPassword($username);
                $user->setEmail($user_sheet->getCellByColumnAndRow(11,$i)->getValue());

                $data_course= $user_sheet->getCellByColumnAndRow(12,$i)->getValue();
                $curso= intval(substr($data_course, 0, 1));
                $data_ciclo= preg_match('/\(([\w ]+)\)/',$data_course,$ciclo_name);
                $name_ciclo= $ciclo_name[1];

                array_push($user_array, $user);
            }
        }
        return $user_array;
    }



    function normaliza ($cadena){
        $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        $cadena = utf8_decode($cadena);
        $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
        $cadena = strtolower($cadena);
        return utf8_encode($cadena);
    }

}