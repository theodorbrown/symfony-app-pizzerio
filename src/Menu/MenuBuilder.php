<?php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\Security\Core\Security;

class MenuBuilder
{
    private $factory;

    /**
     * Add any other dependency you need...
     */
    public function __construct(FactoryInterface $factory, private Security $security)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Accueil', ['route' => 'home']);
        $menu->addChild('Les Pizzas', ['route' => 'pizza_index']);
        $menu->addChild('Les Catégories', ['route' => 'category_index']);
        $menu->addChild('Les Catégories', ['route' => 'category_index']);
        // ... add more children
        return $menu;
    }

    public function createUserMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');
        
        $user = $this->security->getUser();
        $child = $menu->addChild($user->getEmail(), ['uri' => '#']);
        $child->addChild('Se déconnecter', ['route' => 'app_logout']);

        return $menu;
    }
}