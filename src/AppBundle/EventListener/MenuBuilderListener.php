<?php
namespace AppBundle\EventListener;

use Sonata\AdminBundle\Event\ConfigureMenuEvent;

class MenuBuilderListener
{
    public function addMenuItems(ConfigureMenuEvent $event)
    {
        $menu = $event->getMenu();
        $menu->addChild("Importación")->setExtras([
            'icon' => '<i class="fa fa-folder"></i>',
        ]);

        $menu['Importación']->addChild('reports', [
            'label' => 'Carga de archivos',
            'route' => 'import_users',
        ]);
    }
}