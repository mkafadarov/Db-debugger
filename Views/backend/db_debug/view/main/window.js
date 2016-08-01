//{block name="backend/db_debug/view/main/window"}
Ext.define('Shopware.apps.DbDebug.view.main.Window', {
    extend: 'Enlight.app.Window',
    alias: 'widget.connect-window',
    cls: Ext.baseCSSPrefix + 'connect',

    layout: 'border',
    width: 1000,
    height: '95%',
    title: 'Db debugger',

    initComponent: function() {
        var me = this;
        me.callParent(arguments);
    }
});
//{/block}