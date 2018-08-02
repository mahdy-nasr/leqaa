<?php
/**
 * Created by PhpStorm.
 * User: mahdynasr
 * Date: 02/08/18
 * Time: 9:23 PM
 */

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;


class AllController extends Controller
{
    public function getData($request)
    {
        return json_decode($request->getContent(), 1);
    }

    private function response($opj, $status=200)
    {
        return new JsonResponse($opj, $status);
    }
    /**
     * @Route("/loginuser", name="userlogin")
     */
    public function createUserAction(Request $request)
    {
        $data = $this->getData($request);
        if (!$data || !isset($data['mobile'])) {
            return $this->response(['msg'=>'not allowed'], 400);
        }


        $em=$this->getDoctrine()->getManager();
        $genus=$em->getRepository('AppBundle:User')->findOneBy(['name'=>$type]);
        return $this->response([]);
    }
}