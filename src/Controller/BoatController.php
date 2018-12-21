<?php

/**
 * Boat Controller File
 *
 * PHP Version 7.2
 *
 * @category Boat
 * @package  App\Controller
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */

namespace App\Controller;

use App\Entity\Boat;
use App\Repository\BoatRepository;
use App\Service\MapManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Boat Controller Class
 *
 * @category Boat
 * @package  App\Controller
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 *
 * @Route("/boat")
 */
class BoatController extends AbstractController
{
    /**
     * A move boat action taking two coordinates
     *
     * @param int $x Given X coordinate
     * @param int $y Given Y coordinate
     * @param BoatRepository $boatRepository Injecting BoatRepository
     * @param EntityManagerInterface $em Using Doctrine manager
     *
     * @Route("/move/{x}/{y}", name="move_boat", requirements={"x"="\d+", "y"="\d+"}, methods={"GET"}))
     *
     * @return RedirectResponse Back on map route
     */
    public function moveBoatAction(
        int $x,
        int $y,
        BoatRepository $boatRepository,
        EntityManagerInterface $em
    ): RedirectResponse {

        if ($boat = $boatRepository->findOneBy(['id' => 1])) {
            $boat->setCoordX($x);
            $boat->setCoordY($y);
            $em->flush();
        }

        return $this->redirectToRoute('map');
    }

    /**
     * A move method with a given direction
     *
     * @param string $direction N|S|E|W
     * @param BoatRepository $boatRepository Injecting BoatRepository
     * @param EntityManagerInterface $em Using Doctrine manager
     * @param MapManager $mapManager Injecting MapManager service
     *
     * @Route("/move/{direction}", name="move_boat_to", requirements={"direction"="N|S|E|W"}, methods={"GET"}))
     *
     * @return RedirectResponse A redirection to map route
     */
    public function moveDirection(
        string $direction,
        BoatRepository $boatRepository,
        EntityManagerInterface $em,
        MapManager $mapManager
    ): RedirectResponse {

        if ($boat = $boatRepository->findOneBy(['id' => 1])) {
            $this->updatingOneCoordinateAccordingToDirection($direction, $boat);
            if ($mapManager->tileExists($boat->getCoordX(), $boat->getCoordY())) {
                $em->flush();
                if ($mapManager->checkTreasure($boat)) {
                    $this->addFlash('success', 'Poursuis ta quête en résolvant les défis !');
                }
            } else {
                $this->addFlash('warning', 'Hum... Dans notre monde, la Terre est plate ! Tu ne peux pas sortir en dehors de la carte...');
            }
        }

        return $this->redirectToRoute('map');
    }

    /**
     * Increment or decrement coordinates according to the given direction
     *
     * @param string $direction Given direction
     * @param Boat $boat Copied and passed pointer to Black Pearl object (return no needed)
     */
    private function updatingOneCoordinateAccordingToDirection(
        string $direction,
        Boat $boat
    ): void {

        switch ($direction) {
            case 'N':
                $boat->setCoordY($boat->getCoordY() - 1);
                break;
            case 'E':
                $boat->setCoordX($boat->getCoordX() + 1);
                break;
            case 'S':
                $boat->setCoordY($boat->getCoordY() + 1);
                break;
            case 'W':
                $boat->setCoordX($boat->getCoordX() - 1);
                break;
        }
    }
}
