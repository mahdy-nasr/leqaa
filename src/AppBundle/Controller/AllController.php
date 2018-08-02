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
        return $request->getContent();
    }

    private function response($opj, $status=200)
    {
        return new JsonResponse($opj, $status);
    }

    private function getOrm()
    {
        return $this->getDoctrine()->getManager();
    }
    /**
     * @Route("/loginuser", name="userlogin")
     */
    public function loginUserAction(Request $request)
    {
        $data = $this->getData($request);
        if (!$data || !isset($data['mobile'])) {
            return $this->response(['msg'=>'not allowed, no mobile'], 400);
        }


        $em= $this->getOrm();
        $user = $em->getRepository('AppBundle:Users')->findOneBy(['mobile'=>$data['mobile']]);
        if (!$user) {
            return $this->response(['msg'=>'not exist'], 400);
        }
        if ($user && $user->getPassword() == $data['password']) {
            return $this->response($user);
        }


        return $this->response(['msg'=>'pasword wront'], 400);
    }
}