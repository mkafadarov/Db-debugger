<?php

namespace Shopware\DbDebugger\Subscribers;

use Enlight\Event\SubscriberInterface;

class ControllerPath implements SubscriberInterface
{
    protected $bootstrap;

    /**
     * ControllerPath constructor.
     * @param \Shopware_Plugins_Backend_DbDebugger_Bootstrap $bootstrap
     */
    public function __construct(\Shopware_Plugins_Backend_DbDebugger_Bootstrap $bootstrap)
    {
        $this->bootstrap = $bootstrap;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            'Enlight_Controller_Dispatcher_ControllerPath_Backend_DbDebug' => 'onGetDbDebugControllerPath'
        );
    }

    /**
     * @param Enlight_Event_EventArgs $arguments
     * @return string
     */
    public function onGetDbDebugControllerPath(Enlight_Event_EventArgs $arguments)
    {
        Shopware()->Template()->addTemplateDir($this->bootstrap->Path() . 'Views/', 'db_debug');

        switch ($arguments->getName()) {
            case 'Enlight_Controller_Dispatcher_ControllerPath_Backend_DbDebug':
                return $this->bootstrap->Path() . 'Controllers/Backend/DbDebug.php';
        }
    }

}