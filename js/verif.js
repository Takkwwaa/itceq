function test(){
    var e = document.f.email.value;
    var p = document.f.pass.value;
    if (e.indexOf('@')>e.indexOf('.'))
    { alert('email invalide');
       return false; }}

function alpha(x){
	x=x.toUpperCase();
	ok=false;
	for(i=0;i<x.length;i++){
		if(x[i]>'Z' ||x[i]<'A'){
			ok=false;
		break;}
		else
	ok=true;
	return ok;}}
function test1(){
    var n=document.f.nom.value;
    var p=document.f.pnom.value;
    var pas=document.f.pass.value;
    var pas1=document.f.pass1.value;
    var numb=document.f.num.value;
	var ps=document.f.poste.selectedIndex;
    if(!alpha(n)){
        alert('verifier votre nom ');
        return false;}
	if(!alpha(p))
	{ alert('verifier votre prenom ');
	return false;}
    if(isNaN(numb)||numb.length>8)
	{alert('verifier votre numéro');
	return false;}
	var i=0;
	while(i<=pas.length && pas[i]===pas1[i]){i++;}
    if(i==pas.length){alert ('les deux mot de passes ne sont pass identique');
	return false;}
	if (ps==0){
		alert('indiquer votre poste sil vous plait');
		return false;
	}
	test();
    
}
