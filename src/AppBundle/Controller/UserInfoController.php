<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class UserInfoController extends Controller
{
    /**
     * @Route("/updateInfo", name="update_info")
     * @Security("is_authenticated()")
     */
    public function updateInfoAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $currentUser= $this->getUser();

        $form = $this->createFormBuilder($currentUser)
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Update info'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $currentUser = $form->getData();
            $manager->persist($currentUser);
            $manager->flush();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $em = $this->getDoctrine()->getManager();
            // $em->persist($task);
            // $em->flush();

            $this->addFlash('success', 'Info successfully updated');
            return $this->redirect('/updateInfo');
        }

        return $this->render('default/updateInfo.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
