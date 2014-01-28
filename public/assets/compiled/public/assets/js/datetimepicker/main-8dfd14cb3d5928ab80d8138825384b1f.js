
/*
 * Initialize all the others
 */
$( '.js__datepicker' ).pickadate($.extend( $.fn.pickadate.defaults, {
    monthsFull: [ 'januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december' ],
    monthsShort: [ 'jan', 'feb', 'maa', 'apr', 'mei', 'jun', 'jul', 'aug', 'sep', 'okt', 'nov', 'dec' ],
    weekdaysFull: [ 'zondag', 'maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag' ],
    weekdaysShort: [ 'zo', 'ma', 'di', 'wo', 'do', 'vr', 'za' ],
    today: 'vandaag',
    clear: 'verwijderen',
    firstDay: 1,
    format: 'dddd d mmmm yyyy',
    formatSubmit: 'yyyy-mm-dd',
    hiddenPrefix: 'd__',
    hiddenSuffix: '__m',
    min: new Date(),
    max: +60,
    
    
}))

$( '.js__timepicker' ).pickatime({
    min: [8,30],
    max: [17,00],
    format: 'HH:i',
    interval: 15,
})

$( '.js__birthdaypicker' ).pickadate($.extend( $.fn.pickadate.defaults, {
    monthsFull: [ 'januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december' ],
    monthsShort: [ 'jan', 'feb', 'maa', 'apr', 'mei', 'jun', 'jul', 'aug', 'sep', 'okt', 'nov', 'dec' ],
    weekdaysFull: [ 'zondag', 'maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag' ],
    weekdaysShort: [ 'zo', 'ma', 'di', 'wo', 'do', 'vr', 'za' ],
    today: 'vandaag',
    clear: 'verwijderen',
    firstDay: 1,
    format: 'dddd d mmmm yyyy',
    formatSubmit: 'yyyy-mm-dd',
    hiddenPrefix: 'd__',
    hiddenSuffix: '__m',
    min: [1970, 01, 01],
    max: new Date(),
    selectMonths: true,
    selectYears: 30
}))
