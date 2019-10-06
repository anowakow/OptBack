<?php
namespace App\Controller\Api;


use App\Entity\User;
use App\Entity\Subject;
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

class CourseController extends FOSRestController
{
    /**
     * @Route("/allActiveCourses/{subject_id}", name="all_active_courses",requirements={"subject_id": "\d+"},  methods={"GET"})
     * @param Request $request
     * @param UserManagerInterface $userManager
     * 
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function allActiveCourses(Request $request, UserManagerInterface $userManager, $subject_id)
    {
        //print("SUBJECT ID");
        //print_r($subject_id);
        $subjectRepo = $this->getDoctrine()->getRepository(Subject::class);
        $subject = $subjectRepo -> findBy(array('id' => $subject_id ));
        //print_r($subject);
        $repository = $this->getDoctrine()->getRepository(Course::class);
        $courses = $repository->findBy(array('subject' => $subject,'active' => 1 ));
      
        return $this->handleView($this->view($courses));
    }

    /**
     * @Route("/allCourses/{subject_id}", name="all_courses",requirements={"subject_id": "\d+"},  methods={"GET"})
     * @param Request $request
     * @param UserManagerInterface $userManager
     * 
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function allCourses(Request $request, UserManagerInterface $userManager, $subject_id)
    {
        
        $subjectRepo = $this->getDoctrine()->getRepository(Subject::class);
        $subject = $subjectRepo -> findBy(array('id' => $subject_id ));
        //print_r($subject);
        $repository = $this->getDoctrine()->getRepository(Course::class);
        $courses = $repository->findBy(array('subject' => $subject,'active' => 1 ));
      
        return $this->handleView($this->view($courses));
    }


   /**
     * @Route("/addCourse", name="add_course",  methods={"POST"})
     * @param Request $request
     * @param UserManagerInterface $userManager
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
  public function addCourseAction(Request $request, UserManagerInterface $userManager)
  {
    $course = new Course();
    // $form = $this->createForm(MovieType::class, $movie);
    $data = json_decode($request->getContent(), true);
    $name = $data["name"];
    $description = $data["description"];
    $icon = $data["icon"];
    $subject_id = $data["subject_id"];
    
    $subject_repository = $this->getDoctrine()->getRepository(Subject::class);
    $subject = $subject_repository ->findOneBy(array('id' => $subject_id));
    //int_r($subject);
    $course->setName($name);
    $course->setDescription($description);
    $course->setIcon($icon);
    $course->setSubject($subject);
    //$form->submit($data);
   // if ($form->isSubmitted() && $form->isValid()) {
    $em = $this->getDoctrine()->getManager();
    $em->persist($course);
    $em->flush();
      return $this->handleView($this->view(['status' => 'ok'], Response::HTTP_CREATED));
    //}
    return $this->handleView($this->view($form->getErrors()));
  }
}