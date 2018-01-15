$(document).ready(function() {
            $("body").css("display", "none");
            $("body").fadeIn(800);
			
			$('a[href!="#"]').click(function(event){
				event.preventDefault();
				linkLocation = this.href;
				$("body").fadeOut(400, redirectPage);		
			});
				
			function redirectPage() {
				window.location = linkLocation;
			}
    });