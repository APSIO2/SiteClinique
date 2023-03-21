function classSuivante(nombre){

    if(nombre == 2){

        num = document.getElementById("secu").value;
        mail = document.getElementById("mail").value;
        cp_pat = document.getElementById("cp_pat").value;
        tel_pat = document.getElementById("tel_pat").value;
        

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

        if(!checkTel(tel_pat)){
            document.getElementById("tel_pat").style.border = "2px solid red";
        }else{
            document.getElementById("tel_pat").style.border = "none";
        }

        
        if(!checkCp(cp_pat)){
            document.getElementById("cp_pat").style.border = "2px solid red";
        }else{
            document.getElementById("cp_pat").style.border = "none";
        }
        

    }else if(nombre == 4){
        
        cp_conf = document.getElementById("cp_conf").value;
        tel_conf = document.getElementById("tel_conf").value;

        
        if(checkTel(tel_conf) && checkCp(cp_conf)){
            document.getElementById("form"+nombre).className = "disabled"
            nombre++;
            document.getElementById("form"+nombre).className = "enabled";
        }
        

        if(!checkTel(tel_conf)){
            document.getElementById("tel_conf").style.border = "2px solid red";
        }else{
            document.getElementById("tel_conf").style.border = "none";
        }

        
        if(!checkCp(cp_conf)){
            document.getElementById("cp_conf").style.border = "2px solid red";
        }else{
            document.getElementById("cp_conf").style.border = "none";
        }



    }else if(nombre == 5){
        
        cp_prev = document.getElementById("cp_prev").value;
        tel_prev = document.getElementById("tel_prev").value;
        
        if(!checkTel(tel_prev)){
            document.getElementById("tel_prev").style.border = "2px solid red";
        }else{
            document.getElementById("tel_prev").style.border = "none";
        }

        
        if(!checkCp(cp_prev)){
            document.getElementById("cp_prev").style.border = "2px solid red";
        }else{
            document.getElementById("cp_prev").style.border = "none";
        }

                
        if(checkTel(tel_prev) && checkCp(cp_prev)){
            document.getElementById("form"+nombre).className = "disabled"
            nombre++;
            document.getElementById("form"+nombre).className = "enabled";
        }

    }
    
    else{

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

function checkTel(tel){

    if(tel.length >= 8 && tel.length <= 10){
        return true;
    }
    return false;

}

function checkCp(cp){

    if(cp.length == 5){
        return true;
    }
    return false;

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