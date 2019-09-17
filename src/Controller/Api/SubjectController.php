<?php
namespace App\Controller\Api;


use App\Entity\User;
use App\Entity\Subject;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\UserBundle\Model\UserManagerInterface;
use FOS\RestBundle\View\View;

class SubjectController extends FOSRestController
{
    /**
     * @Route("/allActiveSubjects", name="all_active_subjects",  methods={"GET"})
     * @param Request $request
     * @param UserManagerInterface $userManager
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function allActiveSubjects(Request $request, UserManagerInterface $userManager)
    {
        $repository = $this->getDoctrine()->getRepository(Subject::class);
        $subjects = $repository->findall();
        return $this->handleView($this->view($subjects));
    }

   /**
     * @Route("/allSubjects", name="all_subjects",  methods={"GET"})
     * @param Request $request
     * @param UserManagerInterface $userManager
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
  public function getAllSubjectsAction(Request $request, UserManagerInterface $userManager)
  {
    $repository = $this->getDoctrine()->getRepository(Subject::class);
    $subjects = $repository->findall();
    return $this->handleView($this->view($subjects));
  }

   /**
     * @Route("/addSubject", name="add_subject",  methods={"POST"})
     * @param Request $request
     * @param UserManagerInterface $userManager
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
  public function addSubjectAction(Request $request, UserManagerInterface $userManager)
  {
    $subject = new Subject();
    // $form = $this->createForm(MovieType::class, $movie);
    $data = json_decode($request->getContent(), true);
    $name = $data["name"];
    $description = $data["description"];
    $icon = $data["icon"];
    $subject->setName($name);
    $subject->setDescription($description);
    $subject->setIcon($icon);
    //$form->submit($data);
   // if ($form->isSubmitted() && $form->isValid()) {
    $em = $this->getDoctrine()->getManager();
    $em->persist($subject);
    $em->flush();
      return $this->handleView($this->view(['status' => 'ok'], Response::HTTP_CREATED));
    //}
    return $this->handleView($this->view($form->getErrors()));
  }
}