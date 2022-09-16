function classSuivante(nombre){

    document.getElementById("form"+nombre).className = "disabled"
    nombre++;
    document.getElementById("form"+nombre).className = "enabled";


}

function classPrecedente(nombre){

    document.getElementById("form"+nombre).className = "disabled"
    nombre--;
    document.getElementById("form"+nombre).className = "enabled";


}