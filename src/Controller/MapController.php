<?php

/**
 * Map Controller File
 *
 * PHP Version 7.2
 *
 * @category Map
 * @package  App\Controller
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */

namespace App\Controller;

use App\Repository\TileRepository;
use App\Service\MapManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\BoatRepository;

/**
 * Map Controller Class
 *
 * @category Map
 * @package  App\Controller
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */
class MapController extends AbstractController
{
    /**
     * Display a map with some tiles and one boat
     *
     * @param BoatRepository $boatRepository Injecting BoatRepository
     * @param TileRepository $tileRepository Injecting TileRepository
     *
     * @Route("/map", name="map", methods={"GET"})
     *
     * @return Response A Response instance
     */
    public function displayMapAction(
        BoatRepository $boatRepository,
        TileRepository $tileRepository
    ): Response {

        $tiles = $tileRepository->findAll();
        foreach ($tiles as $tile) {
            $map[$tile->getCoordX()][$tile->getCoordY()] = $tile;
        }

        $boat = $boatRepository->findOneBy(['id' => 1]);

        return $this->render('map/index.html.twig', [
            'map'  => $map ?? [],
            'boat' => $boat,
        ]);
    }

    /**
     * A start action method removing past treasure to add new one, with a new boat
     *
     * @param TileRepository $tileRepository Injecting tileRepository
     * @param BoatRepository $boatRepository Injecting boatRepository
     * @param MapManager $mapManager Injecting MapManager service
     * @param EntityManagerInterface $em Using Doctrine manager
     *
     * @Route("/start", name="start", methods={"GET"})
     *
     * @return RedirectResponse A redirection to map route
     */
    public function startAction(
        TileRepository $tileRepository,
        BoatRepository $boatRepository,
        MapManager $mapManager,
        EntityManagerInterface $em
    ): RedirectResponse {

        $tileRepository->removeAllTreasures();
        $treasureIsland = $mapManager->getRandomIsland();
        $treasureIsland->setHasTreasure(true);

        if ($boat = $boatRepository->findOneBy(['id' => 1])) {
            $boat->setCoordX(0)->setCoordY(0);
            $em->flush();
        }

        return $this->redirectToRoute('map');
    }
}
