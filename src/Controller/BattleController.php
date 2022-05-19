<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\BattleType;
use App\Model\BattleDecider;
use App\Model\Fleet;
use App\Repository\Battle;
use App\Repository\Outcome;
use App\Repository\ShipStorage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormFactoryInterface;

class BattleController extends AbstractController
{
    private Environment $twig;
    private ShipStorage $shipStorage;
    private FormFactoryInterface $formFactory;

    public function __construct(
        Environment $twig,
        ShipStorage $shipStorage,
        FormFactoryInterface $formFactory
    ){
        $this->twig = $twig;
        $this->shipStorage = $shipStorage;
        $this->formFactory = $formFactory;
    }

    public function battle(Request $request): Response
    {
        $form = $this->formFactory->create(
            BattleType::class,
            null,
            [
                'action' => $this->generateUrl('battle_show'),
            ]
        );

        $form->handleRequest($request);

//        $ship1 = $this->shipStorage->fetchSingleShipData($ship1Id);
//        $ship2 = $this->shipStorage->fetchSingleShipData($ship2Id);
//
//        $fleet1 = new Fleet($ship1, $ship1Quantity);
//        $fleet2 = new Fleet($ship2, $ship2Quantity);
//
//        $battleDecider = new BattleDecider();
//
//        $fleetBattle = new Battle($battleDecider);
//
//        $outcome = new Outcome($fleet1, $fleet2);

        return new Response($this->twig->render(
            'battle.html.twig',
            [
                'ship1' => $ship1,
                'ship2' => $ship2,
                'ship1Quantity' => $ship1Quantity,
                'ship2Quantity' => $ship2Quantity,
                'outcome' => $outcome,
                'battleDecider' => $battleDecider,
                'fleetBattle' => $fleetBattle
            ]
        ));
    }
}