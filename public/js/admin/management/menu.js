"use strict";

var KTTreeview = function () {

    var tree_card = function() {
        $("#tree_card").jstree({
            "core" : {
                "themes" : {
                    "responsive": false
                },
                // so that create works
                "check_callback" : true,
                'data': [{
                        "text": "Parent Node",
                        "children": [{
                            "text": "Initially selected",
                            "state": {
                                "selected": true
                            }
                        }, {
                            "text": "Custom Icon",
                            "icon": "flaticon2-hourglass-1 text-danger"
                        }, {
                            "text": "Initially open",
                            "icon" : "fa fa-folder text-success",
                            "state": {
                                "opened": true
                            },
                            "children": [
                                {"text": "Another node", "icon" : "fa fa-file text-waring"}
                            ]
                        }, {
                            "text": "Another Custom Icon",
                            "icon": "flaticon2-drop text-waring"
                        }, {
                            "text": "Disabled Node",
                            "icon": "fa fa-check text-success",
                            "state": {
                                "disabled": true
                            }
                        }, {
                            "text": "Sub Nodes",
                            "icon": "fa fa-folder text-danger",
                            "children": [
                                {"text": "Item 1", "icon" : "fa fa-file text-waring"},
                                {"text": "Item 2", "icon" : "fa fa-file text-success"},
                                {"text": "Item 3", "icon" : "fa fa-file text-default"},
                                {"text": "Item 4", "icon" : "fa fa-file text-danger"},
                                {"text": "Item 5", "icon" : "fa fa-file text-info"}
                            ]
                        }]
                    },
                    "<label>Another Node</label>"
                ]
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder text-primary"
                },
                "file" : {
                    "icon" : "fa fa-file  text-primary"
                }
            },
            "state" : { "key" : "demo2" },
            "plugins" : [ "contextmenu", "state", "types" ]
        });
    }

    var edit_card = function() {
        // This card is lazy initialized using data-card="true" attribute. You can access to the card object as shown below and override its behavior
        var card = new KTCard('edit_card');

        // Toggle event handlers
        card.on('beforeCollapse', function(card) {
            setTimeout(function() {
                toastr.info('Before collapse event fired!');
            }, 100);
        });

        card.on('afterCollapse', function(card) {
            setTimeout(function() {
                toastr.warning('Before collapse event fired!');
            }, 2000);
        });

        card.on('beforeExpand', function(card) {
            setTimeout(function() {
                toastr.info('Before expand event fired!');
            }, 100);
        });

        card.on('afterExpand', function(card) {
            setTimeout(function() {
                toastr.warning('After expand event fired!');
            }, 2000);
        });

        // Remove event handlers
        card.on('beforeRemove', function(card) {
            toastr.info('Before remove event fired!');

            return confirm('Are you sure to remove this card ?');  // remove card after user confirmation
        });

        card.on('afterRemove', function(card) {
            setTimeout(function() {
                toastr.warning('After remove event fired!');
            }, 2000);
        });

        // Reload event handlers
        card.on('reload', function(card) {
            toastr.info('Leload event fired!');

            KTApp.block(card.getSelf(), {
                type: 'loader',
                state: 'success',
                message: 'Please wait...'
            });

            // update the content here

            setTimeout(function() {
                KTApp.unblock(card.getSelf());
            }, 2000);
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            tree_card();
            edit_card();
        }
    };
}();

jQuery(document).ready(function() {
    KTTreeview.init();
});
