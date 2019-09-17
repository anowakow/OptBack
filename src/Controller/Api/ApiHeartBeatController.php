<?php
namespace App\Controller\Api;use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class ApiHeartBeatController extends AbstractController
{
    /**
     * @Route("/heartbeat", name="api_heartbeat",  methods={"GET"})
     * @param Request $request
     * @param UserManagerInterface $userManager
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function heartbeat(Request $request, UserManagerInterface $userManager)
    {
        
        $data = json_decode(
            $request->getContent(),
            true
        );        

                return new JsonResponse(["success response"], 200);
    }
}