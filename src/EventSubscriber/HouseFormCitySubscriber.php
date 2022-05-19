<?php

namespace App\EventSubscriber;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\NotBlank;

class HouseFormCitySubscriber implements EventSubscriberInterface
{

    public function __construct(private EntityManagerInterface $em)
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SUBMIT => 'onPreSubmit',
            FormEvents::PRE_SET_DATA => 'onPreSetData',
        ];
    }

    public function onPreSubmit(FormEvent $event): void
    {
        $form = $event->getForm();

        if ($form->has("zipcode") && !$form->has("city")) {
            $data = $event->getData();
            $postCode = $data['zipcode'];
            $conn = $this->em->getConnection();
            $sql = 'SELECT ville_nom FROM spec_villes_france_free WHERE ville_code_postal LIKE :code';
            $stmt = $conn->prepare($sql);
            $resultSet = $stmt->executeQuery(['code' => "%" . $postCode . "%"]);
            $cities = $resultSet->fetchAllAssociative();
            $cityNames = [];
            foreach ($cities as $city) {
                $cityNames[$city['ville_nom']] = $city['ville_nom'];
            }
            $form->add("city", ChoiceType::class, [
                'label' => 'Ville',
                'choices' => $cityNames,
                'expanded' => false,
                'multiple' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer une ville',
                    ]),
                ],
            ]);
        }
    }

    public function onPreSetData(FormEvent $event): void
    {

        $housing = $event->getData();
        $form = $event->getForm();

        if ($housing->getId() != null) {
            $form->remove('houseType');
            $form->remove('zipcode');
            $form->remove('city');
        }
    }
}
