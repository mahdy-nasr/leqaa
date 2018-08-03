<?php
/**
 * Created by PhpStorm.
 * User: mahdynasr
 * Date: 02/08/18
 * Time: 9:23 PM
 */

namespace AppBundle\Controller;
use AppBundle\Entity\Broadcasts;
use AppBundle\Entity\Schedule;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;


class AllController extends Controller
{


    private function response($opj, $status=200)
    {
        if (!$opj) {
            return new JsonResponse(['msg'=>'not exist'], 400);
        }
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
        $qrCode = ltrim($data['qrCode'],"0 ");
        $user = $em->getRepository('AppBundle:Users')->findOneBy(['qrCode'=>$qrCode]);

            return $this->response($user);

    }

    /**
     * @Route("/getConvey")
     */
    public function getConveyAction(Request $request)
    {
        $data = $request->request->get('conveyId');
        $em= $this->getOrm();
        $convey = $em->getRepository('AppBundle:Convey')->findOneBy(['id'=>$data]);

        return $this->response($convey);

    }

    /**
     * @Route("/getconveyusers")
     */
    public function getConveyUsersForAdminAction(Request $request)
    {
        $data = $request->request->get('conveyId');
        $em= $this->getOrm();
        $users = $em->getRepository('AppBundle:Users')->findBy(['conveyId'=>$data]);

        return $this->response($users);
    }

    /**
     * @Route("/getAlerts")
     */
    public function getConveyMissingUsersForAdminAction(Request $request)
    {
        $data = $request->request->get('conveyId');
        $em= $this->getOrm();
        $users = $em->getRepository('AppBundle:Users')->findBy(['conveyId'=>$data, 'missing' => true]);

        return $this->response($users);
    }



    /**
     * @Route("/getNearest")
     */
    public function getNearestUserAction()
    {
        $em= $this->getOrm();
        $user = $em->getRepository('AppBundle:Users')->findOneBy(['qrCode'=>'877683']);

        return $this->response($user);
    }

    /**
     * @Route("/refresh")
     */
    public function refreshUserLocationAction(Request $request)
    {
        $data = $request->request->all();
        if (!$data || !isset($data['location']) || empty($data['location'])) {
            return $this->response($data, 400);
        }
        $location = $data['location'];
        $userId = $data['userId'];

        $em= $this->getOrm();
        $user = $em->getRepository('AppBundle:Users')->findOneBy(['id'=> $userId]);
        $user->setLocation($location);
        $em->persist($user);
        $em->flush();
        if ($user->getRole() == 1)
        {
            $this->refreshConveyLocation($user->getConveyId(), $location);
        }

        return $this->response(['msg' => 'success']);
    }


    public function refreshConveyLocation($conveyId, $location)
    {
        $em= $this->getOrm();
        $convey = $em->getRepository('AppBundle:Convey')->findOneBy(['id'=> $conveyId]);
        $convey->setLocation($location);
        $em->persist($convey);
        $em->flush();
    }

    /**
     * @Route("/getBroadcasts")
     */
    public function getBroadcastsAction(Request $request)
    {
        $data = $request->request->all();
        if (!$data || !isset($data['conveyId']) || empty($data['conveyId'])) {
            return $this->response($data, 400);
        }
        $conveyId = $data['conveyId'];

        $em= $this->getOrm();
        $broadcasts = $em->getRepository('AppBundle:Broadcasts')->findBy(['conveyId'=> $conveyId]);

        return $this->response($broadcasts);
    }

    /**
     * @Route("/getEvents")
     */
    public function getEventsAction(Request $request)
    {
        $data = $request->request->all();
        if (!$data || !isset($data['conveyId']) || empty($data['conveyId'])) {
            return $this->response($data, 400);
        }
        $conveyId = $data['conveyId'];

        $em= $this->getOrm();
        $schedule = $em->getRepository('AppBundle:Schedule')->findBy(['conveyId'=> $conveyId]);

        return $this->response($schedule);
    }

    /**
     * @Route("/addEvent")
     */
    public function addEventAction(Request $request)
    {
        $data = $request->request->all();
        if (!$data) {
            return $this->response($data, 400);
        }
        $time = \DateTime::createFromFormat('Y-m-d\TH:i:s',rtrim($data['time'],"Zz"));
        $name = $data['title'];
        $description = $data['desc'];
        $conveyId = $data['conveyId'];
        $em= $this->getOrm();
        $schad =  new Schedule();
        $schad->setName($name);
        $schad->setTime($time);
        $schad->setConveyId($conveyId);
        $schad->setDescription($description);

        $em->persist($schad);
        $em->flush();

        return $this->response(['msg' => 'success']);
    }

    /**
     * @Route("/addBroadcast")
     */
    public function addBroadcastAction(Request $request)
    {
        $data = $request->request->all();
        if (!$data) {
            return $this->response($data, 400);
        }
        $time = \DateTime::createFromFormat('Y-m-d\TH:i:s',rtrim($data['time'],"Zz"));
        $message = $data['message'];
        $conveyId = $data['conveyId'];
        $em= $this->getOrm();
        $br =  new Broadcasts();
        $br->setTime($time);
        $br->setConveyId($conveyId);
        $br->setMessage($message);
        $br->setUserId(1);

        $em->persist($br);
        $em->flush();

        return $this->response(['msg' => 'success']);
    }




}