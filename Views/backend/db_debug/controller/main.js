//{namespace name="backend/db_debug/view/main"}
//{block name="backend/db_debug/controller/main"}
Ext.define('Shopware.apps.DbDebug.controller.Main', {
    extend: 'Ext.app.Controller',

    init: function() {
        var me = this;

        me.mainWindow = me.getView('main.Window').create({}).show();
    }
});
//{/block}