

$(".playText").on('click', function (e) {
    id = this.id;
    e.preventDefault();
    var text = $("#ReadExpe" + id).val();
    text = encodeURIComponent(text);
    var url = "https://audio1.spanishdict.com/audio?lang=es&text=" + text;
    $("audio").attr('src', url).get(0).play();
   


});

$(".stopText").on('click', function (e) {
    e.preventDefault();
    var text = $("#ReadExpe" + id).val();
    text = encodeURIComponent(text);
    var url = "https://audio1.spanishdict.com/audio?lang=es&text=" + text;
    $("audio").attr('src', url).get(0).pause();
    
});




