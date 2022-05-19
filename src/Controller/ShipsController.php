<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\BattleType;
use App\Model\Ships;
use App\Repository\Outcome;
use App\Repository\ShipStorage;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class ShipsController extends AbstractController
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

    public function homepage(Request $request): Response
    {
        $ships = $this->shipStorage->fetchAllShipsData();
        $battlingShips = new Ships();

        $form = $this->formFactory->create(
            BattleType::class,
            null,
            [
                'ships' => $ships->getShips(),
                'action' => $this->generateUrl('battle_show'),
            ]
        );

//        $battlingShipsData = $request->request->all();

//        if ($form->isSubmitted() && $form->isValid()) {
//            return $this->redirectToRoute('battle_show');
//        }

        return new Response($this->twig->render(
            'base.html.twig',
            [
                'ships' => $ships,
                'form' => $form->createView(),
//                dd($battlingShipsData),
            ]
        ));
    }
}