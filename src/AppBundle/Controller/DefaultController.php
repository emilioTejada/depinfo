<?php

namespace AppBundle\Controller;


use AppBundle\form\DataUploadType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
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

        $submittedForm = $this->createForm(new DataUploadType());
        $submittedForm->handleRequest($request);
        $file= $submittedForm->getData();

        if ($submittedForm->isSubmitted() && $submittedForm->isValid()) {
            $file= $submittedForm->getData();

//            $this->get('app.xls_file_users_importer')->import($file);
            $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject($file->getData()->getRealPath());
            $a= 2;
        }
        return $this->render('@App/import.html.twig', array(
        'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        'file_form' => $submittedForm->createView(),
        ));
    }


    /**
     * Get image mime type
     * @Route("/type", name="get_type")
     * @param $file
     * @return mixed
     */
    public function getMimeType($file)
    {

        return (finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file));

    }

}
