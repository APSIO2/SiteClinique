function classSuivante(nombre){

    if(nombre == 2){

        if(document.getElementById("secu").value.length == 0 || document.getElementById("mail").value.length == 0){
            return;
        }

        num = document.getElementById("secu").value;
        mail = document.getElementById("mail").value;

        if(checkNumSecu(num) && checkMail(mail)){
            document.getElementById("form"+nombre).className = "disabled"
            nombre++;
            document.getElementById("form"+nombre).className = "enabled";
        }
        
        if(!checkMail(mail)){
            document.getElementById("mail").style.border = "2px solid red";
        }else{
            document.getElementById("mail").style.border = "none";
        }

        if(!checkNumSecu(num)){
            document.getElementById("secu").style.border = "2px solid red";
        }else{
            document.getElementById("secu").style.border = "none";
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

function checkMail(mail){

    if(mail.includes("@") && mail.includes(".")){

        return true;

    }

    return false;

}