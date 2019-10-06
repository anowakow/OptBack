<?php
namespace App\Controller\Api;


use App\Entity\User;
use App\Entity\Subject;
use App\Entity\Topic;
use App\Entity\Course;

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

class TopicController extends FOSRestController
{
    /**
     * @Route("/allTopics/{course_id}", name="all_topics", requirements={"course_id": "\d+"},  methods={"GET"})
     * @param Request $request
     * @param UserManagerInterface $userManager
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function allTopics(Request $request, UserManagerInterface $userManager,$course_id)
    {
        
         
      $courseRepo = $this->getDoctrine()->getRepository(Course::class);
      $course = $courseRepo -> findBy(array('id' => $course_id ));
      //print_r($subject);
      $repository = $this->getDoctrine()->getRepository(Topic::class);
      $courses = $repository->findBy(array('course' => $course));
    
      return $this->handleView($this->view($courses));
    }

/**
     * @Route("/allActiveTopics/{course_id}", name="all_active_topics", requirements={"course_id": "\d+"},  methods={"GET"})
     * @param Request $request
     * @param UserManagerInterface $userManager
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function allActiveTopics(Request $request, UserManagerInterface $userManager,$course_id)
    {
        
         
      $courseRepo = $this->getDoctrine()->getRepository(Course::class);
      $course = $courseRepo -> findBy(array('id' => $course_id ));
      //print_r($subject);
      $repository = $this->getDoctrine()->getRepository(Topic::class);
      $courses = $repository->findBy(array('course' => $course,'active' => 1 ));
    
      return $this->handleView($this->view($courses));
    }


   /**
     * @Route("/addTopic", name="add_topic",  methods={"POST"})
     * @param Request $request
     * @param UserManagerInterface $userManager
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
  public function addTopicAction(Request $request, UserManagerInterface $userManager)
  {
    $em = $this->getDoctrine()->getManager();
    $topic = new Topic();
    // $form = $this->createForm(MovieType::class, $movie);
    $data = json_decode($request->getContent(), true);
    //print_r($data);
    $name = $data["name"];
    $description = $data["description"];
    $icon = $data["icon"];
    $course_id = $data["course_id"];
    $active = $data["active"];
    //$course = $em->find("Course", $courseId);
    $course_repository = $this->getDoctrine()->getRepository(Course::class);
    $course = $course_repository ->findOneBy(array('id' => $course_id));

     
    $topic->setName($name);
    $topic->setDescription($description);
    $topic->setIcon($icon);
    $topic->setActive($active);
    $topic->setCourse($course);
    //$form->submit($data);
   // if ($form->isSubmitted() && $form->isValid()) {
    
    $em->persist($topic);
    $em->flush();
      return $this->handleView($this->view(['status' => 'ok'], Response::HTTP_CREATED));
    //}
    return $this->handleView($this->view($form->getErrors()));
  }
}