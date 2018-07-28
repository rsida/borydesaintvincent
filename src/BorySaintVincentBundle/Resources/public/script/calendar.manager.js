$().ready(function() {
    var calendar = $('#calendar').fullCalendar(configuration).fullCalendar('getCalendar');

    $('[data-toggle="popover"]').popover({
        'trigger': 'hover'
    });
});