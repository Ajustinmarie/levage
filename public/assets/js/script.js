$(document).ready( function() {
    var url = "{{ path('recherche') }}";
	$('button').click( function() {
		$('#result').load(url);
			
		
		});
		
});