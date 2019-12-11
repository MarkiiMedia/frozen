//Tjekker form fra register siden
function checkForm(){
    let formElement = document.querySelector("#checkform");
    let userName = formElement.username; 
    let pass1 = formElement.pass1; 
    let pass2 = formElement.pass2; 

    //Sættes til false som udgangspunk
    let enspasswords = false; 

    //Hvis det der er skrevet i begge felter er ens så sættes til true ELLERS besked om at disse skal være ens
    if(pass1.value == pass2.value){
        enspasswords = true; 
    } else {
        alert("Dine password skal være ens");
    }
    //HVIS de er ens, returner true ELLERS false
    if(enspasswords){
        return true;
    }else{
        return false;
    }
}
