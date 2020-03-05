<?php
namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class RoleController extends AbstractController{
   
       /**
    * @Route("/roles_controller", name="roles_app")
    */
       public function roles(){

        $roles = $this->getUser()->getRoles();
        if(in_array('ROLE_USER', $roles)){
            $users=$this->getDoctrine()->getRepository(User::class)->findByRole("ROLE_USER");
            $users_resp=$users;
            print_r($users);
            return  $this->render('security/user.html.twig', ['listUsers' => $users_resp]);
        }
        else if(in_array('ROLE_ADMIN', $roles)){
            $users=$this->getDoctrine()->getRepository(User::class)->findAll();
            return  $this->render('security/user.html.twig', ['listUser' => $users]);
        }
        else if(in_array('ROLE_SUPER', $roles)){
            $users=$this->getDoctrine()->getRepository(User::class)->findByRole("ROLE_SUPER");
            $users2=$this->getDoctrine()->getRepository(User::class)->findByRole("ROLE_USER");
            $totalUser=array_merge($users, $users2);
            return  $this->render('security/user.html.twig', ['listUser' => $totalUser]);
        }
    }
}
?>