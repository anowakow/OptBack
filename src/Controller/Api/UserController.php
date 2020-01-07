<?php
namespace App\Controller\Api;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/login", name="user_opt",  methods={"OPTIONS"})
     * @param Request $request
     * @param UserManagerInterface $userManager
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function login(Request $request, UserManagerInterface $userManager)
    {
        return new JsonResponse(["success" => $user->getUsername(). " options response"], 200);
    }

    /**
     * @Route("/check-for-email", name="check_for_email",  methods={"POST"})
     * @param Request $request
     * @param UserManagerInterface $userManager
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function checkForEmail(Request $request, UserManagerInterface $userManager)
    {
        $data = json_decode(
            $request->getContent(),
            true
        );       
        if($data){
            if($data['email']!=null && strlen($data['email'])>2){
            $user=$userManager->findUserByEmail($data['email']);
            if($user){ 
                return new JsonResponse(["validationResult" => "TRUE"], 200);
            }
            else{ 
                return new JsonResponse(["validationResult" => "FALSE"], 200);
            }
        }

        }
        
        return new JsonResponse(["validationResult" => "ERROR"], 200);
    }

    /**
     * @Route("/register", name="user_register",  methods={"POST"})
     * @param Request $request
     * @param UserManagerInterface $userManager
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function register(Request $request, UserManagerInterface $userManager)
    {
        
        $data = json_decode(
            $request->getContent(),
            true
        );        

            $validator = Validation::createValidator();        
            $constraint = new Assert\Collection(array(
            // the keys correspond to the keys in the input array
            'username' => new Assert\Length(array('min' => 0)),
            'password' => new Assert\Length(array('min' => 6)),
            'name' => new Assert\Length(array('min' => 0)),
            'surname' => new Assert\Length(array('min' => 0)),
            'email' => new Assert\Email(),
            'phone' => new Assert\Length(array('min' => 0))
            
        ));        
        $violations = $validator->validate($data, $constraint);        
        if ($violations->count() > 0) {
            return new JsonResponse(["error" => (string)$violations], 500);
        }        
        $username = $data['username'];
        $password = $data['password'];
        $email = $data['email'];
        $name = $data['name'];
        $surname = $data['surname'];
        $phoneNumber = $data['phone'];        
              
        $user = new User();    
        //print_r($user);
        if(empty($username)){
            $username = $email;  
        }  
        $user
            ->setUsername($username)
            ->setPlainPassword($password)
            ->setEmail($email)            
            ->setEnabled(true)
            ->setRoles(['ROLE_USER'])
            ->setSuperAdmin(false)
            
        ;
       // print_r($user);
        $user->setName($name);
        $user->setSurname($surname);
        $user->setPhoneNumber($phoneNumber);

        try {
            $userManager->updateUser($user, true);
        } catch (\Exception $e) {
            return new JsonResponse(["error" => $e->getMessage()], 500);
        }        return new JsonResponse(["success" => $user->getUsername(). " has been registered!"], 200);
    }
   
}