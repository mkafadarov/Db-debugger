//{block name="backend/db_debug/application"}
Ext.define('Shopware.apps.DbDebug', {
    extend: 'Enlight.app.SubApplication',

    bulkLoad: true,
    loadPath: '{url action=load}',
    views: [
        'main.Window'
    ],
    controllers: ['Main'],

    /**
     * This method will be called when all dependencies are solved and
     * all member controllers, models, views and stores are initialized.
     */
    launch: function() {
        var me = this;
        console.log('asdasdasd');
        me.controller = me.getController('Main');
        return me.controller.mainWindow;
    }
});
//{/block}