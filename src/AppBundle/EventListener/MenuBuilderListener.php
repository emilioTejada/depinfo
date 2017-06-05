<?php
namespace AppBundle\EventListener;

use Sonata\AdminBundle\Event\ConfigureMenuEvent;

class MenuBuilderListener
{
    public function addMenuItems(ConfigureMenuEvent $event)
    {
        $menu = $event->getMenu();
        $menu->addChild("prueba")->setExtras([
            'icon' => '<i class="fa fa-folder"></i>',
        ]);

        $menu['prueba']->addChild('reports', [
            'label' => 'Import users',
            'route' => 'import_users',
        ]);
    }
}