function classSuivante(nombre){

    if(nombre == 2){

        num = document.getElementById("secu").value;

        if(checkNumSecu(num)){
            document.getElementById("form"+nombre).className = "disabled"
            nombre++;
            document.getElementById("form"+nombre).className = "enabled";
        }else{
            document.getElementById("secu").style.border = "2px solid red";
        }
    }else{

        document.getElementById("form"+nombre).className = "disabled"
        nombre++;
        document.getElementById("form"+nombre).className = "enabled";
    }


}

function classPrecedente(nombre){

    document.getElementById("form"+nombre).className = "disabled"
    nombre--;
    document.getElementById("form"+nombre).className = "enabled";


}

function checkNumSecu(num){

    if((num.charAt(0) == 0 || num.charAt(0) > 2 || num.length != 13)){

        console.log("Le numéro de sécurité n'est pas bon")
        return false;

    }else{

        console.log("Le numéro de sécurité est bon")
        return true;

    }



}