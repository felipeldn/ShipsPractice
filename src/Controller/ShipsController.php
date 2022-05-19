<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\BattleType;
use App\Model\Fleet;
use App\Repository\ShipStorage;
use App\Service\Battle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ShipsController extends AbstractController
{
    private Environment $twig;
    private ShipStorage $shipStorage;
    private FormFactoryInterface $formFactory;
    private Battle $battle;

    public function __construct(
        Environment $twig,
        ShipStorage $shipStorage,
        FormFactoryInterface $formFactory,
        Battle $battle
    ){
        $this->twig = $twig;
        $this->shipStorage = $shipStorage;
        $this->formFactory = $formFactory;
        $this->battle = $battle;
    }

    public function homepage(Request $request): Response
    {
        $ships = $this->shipStorage->fetchAllShipsData();

        $form = $this->formFactory->create(
            BattleType::class,
            null,
            [
                'ships' => $ships->getShips(),
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $ship1 = $this->shipStorage->fetchSingleShipData($data['ship1']);
            $ship2 = $this->shipStorage->fetchSingleShipData($data['ship2']);

            $fleet1 = new Fleet($ship1, (int) $data['ship1Quantity']);
            $fleet2 = new Fleet($ship2, (int) $data['ship2Quantity']);

            $outcome = $this->battle->fight($fleet1, $fleet2);

            return new Response($this->twig->render(
                'battle.html.twig',
                [
                    'ship1' => $ship1,
                    'ship2' => $ship2,
                    'ship1Quantity' => $data['ship1Quantity'],
                    'ship2Quantity' => $data['ship2Quantity'],
                    'outcome' => $outcome,
                ]
            ));
        }

        return new Response($this->twig->render(
            'base.html.twig',
            [
                'ships' => $ships,
                'form' => $form->createView(),
            ]
        ));
    }
}