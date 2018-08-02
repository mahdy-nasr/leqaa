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
        $data = $request->request->all();
        if (!$data || !isset($data['mobile'])) {
            return $this->response($data, 400);
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

    /**
     * @Route("/getqruser", name="getQruser")
     */
    public function getQrUserAction(Request $request)
    {
        $data = $request->request->all();
        if (!$data || !isset($data['qrCode'])) {
            return $this->response($data, 400);
        }


        $em= $this->getOrm();
        $user = $em->getRepository('AppBundle:Users')->findOneBy(['qrCode'=>$data['qrCode']]);
        if (!$user) {
            return $this->response(['msg'=>'not exist'], 400);
        }
            return $this->response($user);

    }

    /**
     * @Route("/getConvey")
     */
    public function getConveyAction(Request $request)
    {
        $data = $request->request->get('userId');
        $em= $this->getOrm();
        $user = $em->getRepository('AppBundle:Users')->findOneBy(['qrCode'=>$data['qrCode']]);

    }

    /**
     * @Route("/getConvey")
     */
    public function getConveyUsersForAdminAction(Request $request)
    {
        $data = $request->request->all();
    }

    /**
     * @Route("/getConvey")
     */
    public function getConveyMissingUsersForAdminAction(Request $request)
    {
        $data = $request->request->all();
    }

    /**
     * @Route("/getConvey")
     */
    public function getConveyUsersAction(Request $request)
    {
        $data = $request->request->all();
    }

    /**
     * @Route("/getConvey")
     */
    public function getNearestUserAction(Request $request)
    {
        $data = $request->request->all();
    }

    /**
     * @Route("/getConvey")
     */
    public function refreshUserLocationAction(Request $request)
    {
        $data = $request->request->all();
    }


    public function refreshConveyLocation(Request $request)
    {
    }

    /**
     * @Route("/getConvey")
     */
    public function getBroadcastsAction(Request $request)
    {
        $data = $request->request->all();
    }

    /**
     * @Route("/getConvey")
     */
    public function getEventsAction(Request $request)
    {
        $data = $request->request->all();
    }

    /**
     * @Route("/getConvey")
     */
    public function addEventAction(Request $request)
    {
        $data = $request->request->all();
    }

    /**
     * @Route("/getConvey")
     */
    public function addBroadcastAction(Request $request)
    {
        $data = $request->request->all();
    }




}