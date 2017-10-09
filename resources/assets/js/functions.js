jQuery(document).ready(function ($) {

    "use strict";
    /* Time Countdown
     -------------------------------------------------------------------*/
    $('#time_countdown').countDown({

        targetDate: {
            'day': 31,
            'month': 5,
            'year': 2017,
            'hour': 0,
            'min': 0,
            'sec': 0
        },
        omitWeeks: true

        // targetOffset: {
        //    'day':      0,
        //    'month':    0,
        //    'year':     1,
        //    'hour':     0,
        //    'min':      0,
        //    'sec':      3
        // },
        // omitWeeks: true

    });

});