function permite(elEvento,current_value) {

    var key = window.Event ? elEvento.which : elEvento.keyCode;
    var caracter = String.fromCharCode(key);
    var tempValue = current_value.value+caracter;

    if (key >= 48 && key <= 57) {
        if (filter(tempValue)=== false) {
            return false;
        } else {
            return true;
        }
    } else {
        if (key == 8 || key == 13 || key == 0 || key == 26 || key == 27) {
            return true;
        } else if(key == 46) {
            if (filter(tempValue)=== false) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
}

function filter(__val__) {
    var preg = /^([0-9]+\.?[0-9]{0,2})$/;
    if (preg.test(__val__) === true) {
        return true;
    } else {
        return false;
    }
}


/*+------------------
  | A-Z: 65-90      |
  | a-z: 97-122     |
  | 8 =Backspace    |
  | 13 = Enter      |
  | 26 = Fecha Izq  |
  | 27 = Flecha Der |
  +-----------------+
*/
function validate_string(e,current_value){

    var key = window.Event ? e.which : e.keyCode;
    var caracter = String.fromCharCode(key);
    var tempValue = current_value.value+caracter;
    
    if (key == 8 || key == 13 || key == 26 || key== 27) {
        return true;
    } 
    
    var expreg = /^[A-Za-zñÑáéíóúÁÉÍÓÚ0-9 ]+$/u;
    if (expreg.test(tempValue) === true) {
        return true;
    } else {
        return false;
    }
}

function validate_string_and_point(e,current_value){

    var key = window.Event ? e.which : e.keyCode;
    var caracter = String.fromCharCode(key);
    var tempValue = current_value.value+caracter;
    
    if (key == 8 || key == 13 || key == 26 || key== 27) {
        return true;
    } 
    
    var expreg = /^[A-Za-z0-9 . ]+$/u;
    if (expreg.test(tempValue) === true) {
        return true;
    } else {
        return false;
    }
}
function only_numbers(e,value){
    var key = window.Event ? e.which : e.keyCode;
    return ((key == 8 || key == 13 || key == 26 || key==27 )) || (key >= 48 && key <= 57)
}

window.livewire.on('fileChoosen', () => {
    let inputField = document.getElementById('logo'||'image')
    let file = inputField.files[0]
    let reader = new FileReader();
    reader.onloadend = () => {
        window.livewire.emit('fileUpload', reader.result)
    }
    reader.readAsDataURL(file);
});

  /* Optional Javascript to close the radio button version by clicking it again */
var myRadios = document.getElementsByName('tabs2');
var setCheck;
var x = 0;
    for(x = 0; x < myRadios.length; x++){
        myRadios[x].onclick = function(){
            if(setCheck != this){
                setCheck = this;
            }else{
                this.checked = false;
                setCheck = null;
        }
    };
}