

const botongrabar = document.getElementById("botongrabar"); 
const botonpausar = document.getElementById("botonpausar");  
const texto = document.getElementById("texto");
const btnaAyudaO = document.getElementById("btnaAyudaO"); 
const btnaAyudaC = document.getElementById("btnaAyudaC"); 
const divAyuda = document.getElementById("ayuda"); 




let reconocimiento = new webkitSpeechRecognition(); //creamos un objeto para el reconocimiento de voz
reconocimiento.lang = "es-ES";
reconocimiento.continuous = true;
reconocimiento.interimResults = false;

reconocimiento.onresult = (event) => {
    const results = event.results;
    const frase = results[results.length - 1][0].transcript; // aqui esta la frase 
    texto.value += frase;
}
reconocimiento.onend = (event) => {

}

botongrabar.addEventListener("click", () => {
    reconocimiento.start();
    document.getElementById("botongrabar").style.display = "none";
    document.getElementById("botonpausar").style.display = "inline";
    document.getElementById("Blink").style.display = "inline";
    $("#texto").prop("disabled", true);
    $("#enviar").prop("disabled", true);
    $("#close").prop("disabled", true);
    $("#saves").prop("disabled", true);

    
});

botonpausar.addEventListener("click", () => {
    reconocimiento.abort();
    document.getElementById("botonpausar").style.display = "none";
    document.getElementById("botongrabar").style.display = "inline";
    document.getElementById("Blink").style.display = "none";
    $("#texto").prop("disabled", false);
    $("#enviar").prop("disabled", false);
    $("#close").prop("disabled", false);
    $("#saves").prop("disabled", false);
});

btnaAyudaO.addEventListener("click", () => {
    btnaAyudaO.style.display = "none";
    btnaAyudaC.style.display = "inline";
    divAyuda.setAttribute("style","display: block;");
  
});

btnaAyudaC.addEventListener("click", () => {
    btnaAyudaO.style.display = "inline";
    btnaAyudaC.style.display = "none";
    divAyuda.setAttribute("style","display: none;");
});

$('#close').click(function () {
    $('#texto').val('');
});

//escuchar lo que esta escrito
$(".playText").on('click', function (e) {
    id = this.id;
    e.preventDefault();
    var text = $("#ReadExpe" + id).val();
    text = encodeURIComponent(text);
    var url = "https://audio1.spanishdict.com/audio?lang=es&text=" + text;
    $("audio").attr('src', url).get(0).play();
  

});
//deteener 
$(".stopText").on('click', function (e) {
    e.preventDefault();
    var text = $("#ReadExpe" + id).val();
    text = encodeURIComponent(text);
    var url = "https://audio1.spanishdict.com/audio?lang=es&text=" + text;
    $("audio").attr('src', url).get(0).pause();
    
});




