<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Ciclo;
use AppBundle\Entity\UploadedDataDto;
use AppBundle\form\DataUploadType;
use PHPExcel_IOFactory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserControlBundle\Entity\User;

class DefaultController extends Controller
{

    const DATA_UPLOAD_TYPE = 'AppBundle\form\DataUploadType';

    /**
     * @Route("/index", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('@App/import.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }

    /**
     * @Route("/import", name="import_users")
     */
    public function importAction(Request $request)
    {

        $users = (new UploadedDataDto())->setDataType(UploadedDataDto::USERS);
        $users_form = $this->createForm(self::DATA_UPLOAD_TYPE, $users, ['label'=>'Importar datos de usuarios']);
        $ciclos = (new UploadedDataDto())->setDataType(UploadedDataDto::CICLOS);
        $ciclos_form = $this->createForm(DataUploadType::class, $ciclos, ['label'=>'Importar datos de ciclos']);

        $submittedForm = $this->createForm(new DataUploadType());
        $submittedForm->handleRequest($request);

        if ($submittedForm->isSubmitted() && $submittedForm->isValid()) {
            $uploaded_data= $submittedForm->getData();

            //gestion archivo usuarios
            if ($uploaded_data->getDataType()==UploadedDataDto::USERS){
//            $this->get('app.xls_file_users_importer')->import($submittedForm->getData());
                $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject($submittedForm->getData()->getData()->getRealPath());
                $user_sheet = $phpExcelObject->getSheetByName('ALUMNADO DEL CENTRO');
                $num_rows= $user_sheet->getHighestRow();
                for ($i=6;$i<$num_rows;$i++){
                    if (strcmp($user_sheet->getCellByColumnAndRow(1,$i)->getValue(),"Anulada")!=0){
                        $rol_user = $this->get('repository.rol')->findByName("Alumno")->getResult();
                        $user = New User();
                        $user->setRol($rol_user[0]);

                        $name_and_surname= $user_sheet->getCellByColumnAndRow(0,$i)->getValue();
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

                        $this->getDoctrine()->getManagerForClass('UserControlBundle:User')->persist($user);
                        $this->getDoctrine()->getManagerForClass('UserControlBundle:User')->flush();
                    }
                }
            }
            //gestion archivo ciclos
            if ($uploaded_data->getDataType()==UploadedDataDto::CICLOS){
                $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject($submittedForm->getData()->getData()->getRealPath());
                $sheet_reader = $phpExcelObject->getSheetByName('ciclos');
                $num_rows= $sheet_reader->getHighestRow();
                for ($i=2;$i<$num_rows;$i++){
                    $new_ciclo= new Ciclo();
                    $new_ciclo->setGrado($sheet_reader->getCellByColumnAndRow(0,$i));
                    $new_ciclo->setFamilia($sheet_reader->getCellByColumnAndRow(1,$i));
                    $new_ciclo->setName($sheet_reader->getCellByColumnAndRow(2,$i));
                    $new_ciclo->setPlan($sheet_reader->getCellByColumnAndRow(3,$i));

                    $this->getDoctrine()->getManagerForClass('AppBundle:Ciclo')->persist($new_ciclo);
                    $this->getDoctrine()->getManagerForClass('AppBundle:Ciclo')->flush();
                }
            }
        }
        return $this->render('@App/import.html.twig', array(
        'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        'users_form' => $users_form->createView(),
        'ciclos_form' => $ciclos_form->createView(),
        ));
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
