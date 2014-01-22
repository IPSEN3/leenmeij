var trip = new Trip([
    { sel : $(".startdate"), content : "Kies uw startdatum", expose : true, position : "e"  },
    { sel : $(".enddate"), content : "Kies uw einddatum", expose : true, position : "e"  },
    { sel : $(".zoek"), content : "Kies uw auto", expose : true, position : "e"  },
    { sel : $(".taal"), content : "Wilt u de website in een andere taal?", expose : true, position : "s"  },
    { sel : $(".navbar"), content : "Of ergens naartoe navigeren?", expose : true, position : "s"  }
], {
    delay : 3000,
    tripTheme : "white",
    onTripStart : function() {
        $("body").css({ "background-color" : "#eee" });
    },
    onTripEnd : function() {
        $("body").css({ "background-color" : "#fff" });
    }
});
 
$(".uitleg").on("click", function() {
	console.log('uitleg gestart');
    trip.start();
});