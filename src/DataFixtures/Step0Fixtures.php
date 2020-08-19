<?php

namespace App\DataFixtures;

use App\Entity\Ads;
use App\Entity\Civility;
use App\Entity\ContractsAdminFields;
use App\Entity\Medias;
use App\Entity\MediasArticles;
use App\Entity\MediasMusics;
use App\Entity\MediasPhotos;
use App\Entity\MediasVideos;
use App\Entity\Profile;
use App\Entity\Status;
use App\Repository\ContractsAdminFieldsRepository;
use App\Repository\StatusRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;
use KnpU\LoremIpsumBundle\KnpUIpsum;

/**
 * Class Step4Fixtures
 * @package App\DataFixtures
 */
class Step0Fixtures extends Fixture implements FixtureGroupInterface
{

    /**
     * @var StatusRepository
     */
    private $_statusRepo;

    /**
     * @var \App\Repository\ProfileRepository
     */
    private $_profileRepo;

    public static function getGroups(): array
    {
        return ['group0'];
    }

    public function __construct(StatusRepository $statusRepo)
    {
        $this->_statusRepo = $statusRepo;
    }

    public function load(ObjectManager $manager)
    {
        $data   = array();
        $data[] = array(
            'name'      => 'actif',
            'is_active' => '1',
            'created'   => new \DateTime(),
            'value'     => '1',
            'color'     => '#FFFBC',
        );
        $data[] = array(
            'name'      => 'inactif',
            'is_active' => '1',
            'created'   => new \DateTime(),
            'value'     => '0',
            'color'     => '#FFFBC',
        );
        $data[] = array(
            'name'      => 'En attente de validation par le mentoré',
            'is_active' => '1',
            'created'   => new \DateTime(),
            'value'     => '2',
            'color'     => '#FFFBC',
        );
        $data[] = array(
            'name'      => 'En attente de validation par le mentor',
            'is_active' => '1',
            'created'   => new \DateTime(),
            'value'     => '3',
            'color'     => '#FFFBC',
        );
        $data[] = array(
            'name'      => 'Validé(e)',
            'is_active' => '1',
            'created'   => new \DateTime(),
            'value'     => '4',
            'color'     => '#FFFBC',
        );
        $data[] = array(
            'name'      => 'Annulé(e)',
            'is_active' => '1',
            'created'   => new \DateTime(),
            'value'     => '5',
            'color'     => '#FFFBC',
        );
        $data[] = array(
            'name'      => 'En attente de paiement par le(la) mentoré(e)',
            'is_active' => '1',
            'created'   => new \DateTime(),
            'value'     => '6',
            'color'     => '#FFFBC',
        );
        $data[] = array(
            'name'      => 'Paiement refusé',
            'is_active' => '1',
            'created'   => new \DateTime(),
            'value'     => '7',
            'color'     => '#FFFBC',
        );
        $data[] = array(
            'name'      => "Paiement en attente d'acceptation",
            'is_active' => '1',
            'created'   => new \DateTime(),
            'value'     => '8',
            'color'     => '#FFFBC',
        );
        $data[] = array(
            'name'      => 'Paiement validé',
            'is_active' => '1',
            'created'   => new \DateTime(),
            'value'     => '9',
            'color'     => '#FFFBC',
        );
        $data[] = array(
            'name'      => 'En attente de validation',
            'is_active' => '1',
            'created'   => new \DateTime(),
            'value'     => '10',
            'color'     => '#FFFBC',
        );
        $data[] = array(
            'name'      => 'Session terminée',
            'is_active' => '1',
            'created'   => new \DateTime(),
            'value'     => '11',
            'color'     => '#FFFBC',
        );

        $data[] = array(
            'name'      => "En attente d'annulation",
            'is_active' => '1',
            'created'   => new \DateTime(),
            'value'     => '12',
            'color'     => '#FFFBC',
        );
        $data[] = array(
            'name'      => "Annulation refusée",
            'is_active' => '1',
            'created'   => new \DateTime(),
            'value'     => '13',
            'color'     => '#FFFBC',
        );
        $data[] = array(
            'name'      => "Annulation acceptée",
            'is_active' => '1',
            'created'   => new \DateTime(),
            'value'     => '14',
            'color'     => '#FFFBC',
        );
        $data[] = array(
            'name'      => "Validation refusée",
            'is_active' => '1',
            'created'   => new \DateTime(),
            'value'     => '15',
            'color'     => '#FFFBC',
        );

        foreach ($data as $row) {
            $status = new Status();
            $status->setName($row['name'])->setIsActive($row['is_active'])->setValue($row['value'])->setColor($row['color']);
            $manager->persist($status);
            $manager->flush();
        }

        //MAJ des civilités
        $data = [];
        $data[] = array(
            'name'      => 'Homme',
            'created'   => new \DateTime(),
        );
        $data[] = array(
            'name'      => 'Femme',
            'created'   => new \DateTime(),
        );
        $data[] = array(
            'name'      => 'Transgenre',
            'created'   => new \DateTime(),
        );
        foreach ($data as $row) {
            $status = new Civility();
            $status->setName($row['name'])->setCreated($row['created']);
            $manager->persist($status);
            $manager->flush();
        }
    }

}