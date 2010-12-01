/*
 * jQuery aMail plug-in 1.0
 * (c) 2009 Max Ya  ( http://iHackWeb.com )
 * Inspired by epemail plugin/
 *
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 * 
 * HOW TO USE
 
 THE DOM
	example: $('#email').amail('||','|','NOSPAM');
 
 THE PAGE CODE
	Using Example:  <a class="amail" title="my email">lim||fromNOSPAMru|com</a>  
	it will be <a title="my email" class="amail" href="mailto:lim@fromru.com">my email</a>
	
 *
*/
$.fn.amail = function(sAt,sDot,sRepl){

	if (!sAt)
		sAt = '||';
		
	if (!sDot)
		sDot = '|';
	
	if (!sRepl)
		sRepl = 'NOSPAM';
	
	
	this.each(function() {
					  
		el = $(this);
		var mail = el.text().replace(sAt,'@').replace(sDot,'.').replace(sRepl,'');
		el.each(function(){
		el.attr('href','mailto:' + mail);
		if(el.attr('title')){
			el.html(el.attr('title'));
		}else{
			el.html(mail);
			}
		});
	});
};
