function alertt(txt){Swal.fire(
            'Attention',
            txt,
            'warning'
        )}
function controle() {
    var t = document.getElementById("lib_rec").value;
    var tt = document.getElementById("desc").value;
    var typee = document.f.type.selectedIndex;
    var emall = document.f.getElementById("email").value;
    if (t == ''  ) {
        alertt('Le titre ne doive pas etre vide ou déja utiliser');
        return false;
    }
    else if ( tt == ''){
        alertt('Il faut décriver le probléme');
        return false;
    }
    else if(email==''){
        alertt('Il faut indiquer votre email');
        return false;
    }
    else if(typee == 0){
        alertt('Il faut choisir un type');
        return false;
    }
}




