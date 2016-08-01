<?php

/**
 * @category  Shopware
 * @package   Shopware\Plugins\DbDebugger
 */
class Shopware_Plugins_Backend_DbDebugger_Bootstrap extends Shopware_Components_Plugin_Bootstrap
{

    /**
     * Returns the current version of the plugin.
     *
     * @return string|void
     * @throws Exception
     */
    public function getVersion()
    {
        return '0.1';
//        $info = json_decode(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'plugin.json'), true);
//
//        if ($info) {
//            return $info['currentVersion'];
//        } else {
//            throw new \Exception('The plugin has an invalid version file.');
//        }
    }

    /**
     * Returns a nice name for plugin manager list
     *
     * @return string
     */
    public function getLabel()
    {
        return 'DataBase Debugger';
    }

    /**
     * @return array
     */
    public function getInfo()
    {
        return array(
            'version' => $this->getVersion(),
            'label' => $this->getLabel(),
//            'description' => file_get_contents($this->Path() . 'info.txt'),
            'link' => 'http://www.shopware.de/',
        );
    }

    /**
     * Creates the Auctoin history backend menu item.
     *
     * The Autcions menu item opens the listing for the Auction history of the plugin.
     */
    public function createMenu()
    {
        $this->createMenuItem(array(
            'label' => 'Db debugger',
            'controller' => 'DbDebug',
//            'class' => 'sprite-metronome',
            'action' => 'Index',
            'active' => 1,
            'parent' => $this->Menu()->findOneBy(array('label' => 'Marketing')),
            'position' => 4
        ));
    }

    /**
     * @return array|bool
     */
    public function install()
    {
        try {
            $this->createMenu();
            $this->subscribeEvents();
            return true;
        } catch (\Exception $e) {
            return array(
                'success' => false,
                'message' => $e->getMessage()
            );
        }
    }

    /**
     * @return bool
     */
    public function uninstall()
    {
        try {

        } catch (\Exception $e) {
            //noting to do here
        }

        return true;
    }

    /**
     * After init event of the bootstrap class.
     *
     * The afterInit function registers the custom plugin models.
     */
    public function afterInit()
    {
        $this->Application()->Loader()->registerNamespace('Shopware\DbDebugger', $this->Path());
    }


    /**
     * Registers all necessary events.
     */
    public function subscribeEvents()
    {
        $this->subscribeEvent('Enlight_Controller_Front_DispatchLoopStartup', 'onStartDispatch');
    }

    /**
     * @param Enlight_Event_EventArgs $args
     */
    public function onStartDispatch(Enlight_Event_EventArgs $args)
    {
        $subscribers = array(
            new \Shopware\DbDebugger\Subscribers\ControllerPath($this),
        );

        foreach ($subscribers as $subscriber) {
            $this->Application()->Events()->addSubscriber($subscriber);
        }
    }
}