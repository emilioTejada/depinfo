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
use UserControlBundle\Repository\RolRepository;

class ImportController extends Controller
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


        //creación de formularios
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
                try {
                    $users_array = $this->get('app.xls_file_users_importer')->import($submittedForm->getData());

                    for ($i=0; $i<count($users_array); $i++){
                        $this->getDoctrine()->getManagerForClass('UserControlBundle:User')->persist($users_array[$i]);
                    }
                    $this->getDoctrine()->getManagerForClass('UserControlBundle:User')->flush();

                } catch (\Exception $e) {
                    $this->addFlash('error', $this->get('translator')->trans('importation.error'));
                    return $this->redirectToRoute('import_users');
                }

                $this->addFlash('success', $this->get('translator')->trans('importation.successful'));


            }
            //gestion archivo ciclos
            if ($uploaded_data->getDataType()==UploadedDataDto::CICLOS){

                try {
                    $ciclos_array = $this->get('app.xls_file_ciclos_importer')->import($submittedForm->getData());
                    for ($i=0; $i<count($ciclos_array); $i++){
                        $this->getDoctrine()->getManagerForClass('AppBundle:Ciclo')->persist($ciclos_array[$i]);
                    }
                    $this->getDoctrine()->getManagerForClass('AppBundle:Ciclo')->flush();


                } catch (\Exception $e) {
                    $this->addFlash('error', $this->get('translator')->trans('importation.error'));
                    return $this->redirectToRoute('import_users');
                }

                $this->addFlash('success', $this->get('translator')->trans('importation.successful'));

            }
        }
        return $this->render('@App/import.html.twig', array(
        'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        'users_form' => $users_form->createView(),
        'ciclos_form' => $ciclos_form->createView(),
        ));
    }



}
