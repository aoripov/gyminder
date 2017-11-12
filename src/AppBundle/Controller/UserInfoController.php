<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Cluster;
use AppBundle\Entity\Gym;
use AppBundle\Form\GymType;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use  Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class UserInfoController extends Controller
{
    const WEEK_DAYS = [
        'Monday' => 'Monday',
        'Tuesday' => 'Tuesday',
        'Wednesday' => 'Wednesday',
        'Thursday' => 'Thursday',
        'Friday' => 'Friday',
        'Saturday' => 'Saturday',
        'Sunday' => 'Sunday'
    ];

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
            $currentUser = $form->getData();
            $manager->persist($currentUser);
            $manager->flush();

            $this->addFlash('success', 'Info successfully updated');
            return $this->redirect('/updateInfo');
        }

        return $this->render('default/updateInfo.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/addGym", name="add_gym")
     * @Security("is_authenticated()")
     */
    public function addGymAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $gym = new Gym();

        $form = $this->createFormBuilder($gym)
            ->add('Name', TextType::class)
            ->add('lat', NumberType::class, ['label' => 'Latitude'])
            ->add('lng', NumberType::class, ['label' => 'Longtitude'])
            ->add('save', SubmitType::class, array('label' => 'Add gym location'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $gym = $form->getData();
            $manager->persist($gym);
            $manager->flush();

            $this->addFlash('success', 'Gym added successfully');
            return $this->redirect('/');
        }

        return $this->render('default/updateInfo.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/addCluster", name="add_cluster")
     * @Security("is_authenticated()")
     */
    public function addClusterAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $cluster= new Cluster();
        $cluster->setTrainer($user);
        $cluster->setCreationDate(new \DateTime());
        $gyms = $this->getDoctrine()->getRepository(Gym::class)->findAll();

        $form = $this->createFormBuilder($cluster)
            ->add('name', TextType::class)
            ->add('gym', EntityType::class, [
                'class' => Gym::class,
                'choices' => $gyms,
                'choice_value' => 'name',
            ])
            ->add('weekDays', ChoiceType::class, array(
                'choices'  => self::WEEK_DAYS,
                'multiple' => true,
            ))
            ->add('time', TimeType::class, array(
                'input'  => 'datetime',
                'widget' => 'choice',
            ))
            ->add('save', SubmitType::class, array('label' => 'Create new group (cluster)'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cluster = $form->getData();
            $manager->persist($cluster);
            $manager->flush();

            $this->addFlash('success', 'Group was successfully created');
            return $this->redirect('/');
        }

        return $this->render('default/updateInfo.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
