$(function(){
    $('#input-date').daterangepicker({
        "showDropdowns": true,
        "timePicker": true,
        "ranges": {
            "Today": [
                moment().startOf('day'),
                moment().endOf('day')
            ],
            "Yesterday": [
                moment().subtract(1, 'day').startOf('day'),
                moment().subtract(1, 'day').endOf('day')
            ],
            "Last 7 Days": [
                moment().subtract(6, 'days').startOf('day'),
                moment().endOf('day')
            ],
            "Last 30 Days": [
                moment().subtract(29, 'days').startOf('day'),
                moment().endOf('day')
            ],
            "This Month": [
                moment().startOf('month'),
                moment().endOf('month')
            ],
            "Last Month": [
                moment().subtract(1, 'month').startOf('month'),
                moment().subtract(1, 'month').endOf('month')
            ],
            "This Year": [
                moment().startOf('year'),
                moment().endOf('day')
            ],
        },
        "minDate": "5/22/2015",
        "isInvalidDate": function(date) {
            return date.isAfter(moment());
        }
    }, function(start, end, label) {
      console.log("New date range selected: " + start.format('YYYY-MM-DD') + " to " + end.format('YYYY-MM-DD') + " (predefined range: " + label + ")");
    });
});
