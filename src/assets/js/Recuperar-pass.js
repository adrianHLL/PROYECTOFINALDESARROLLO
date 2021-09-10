
$(function() {

    $("#contactForm input").jqBootstrapValidation({
      preventSubmit: true,
      submitError: function($form, event, errors) {
        
      },
      submitSuccess: function($form, event) {
        event.preventDefault(); 
    
        var cedula = $("input#cedula").val();

        if (firstName.indexOf(' ') >= 0) {
          firstName = name.split(' ').slice(0, -1).join(' ');
        }
        $this = $("#sendMessageButton");
        $this.prop("disabled", true); 
        $.ajax({
          url: "././resources/recuperar-pass.php",
          type: "POST",
          data: {
            cedula: cedula,
          },
          cache: false,
          success: function() {
            
            $('#success').html("<div class='alert alert-success'>");
            $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
              .append("</button>");
            $('#success > .alert-success')
              .append("<strong>Tu mensaje ha sido enviado. </strong>");
            $('#success > .alert-success')
              .append('</div>');
            
            $('#contactForm').trigger("reset");
          },
          error: function() {
          
            $('#success').html("<div class='alert alert-danger'>");
            $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
              .append("</button>");
            $('#success > .alert-danger').append($("<strong>").text("Sorry " + firstName + ", parece que mi servidor de correo no responde. Por favor, inténtelo de nuevo más tarde!"));
            $('#success > .alert-danger').append('</div>');
           
            $('#contactForm').trigger("reset");
          },
          complete: function() {
            setTimeout(function() {
              $this.prop("disabled", false); 
            }, 1000);
          }
        });
      },
      filter: function() {
        return $(this).is(":visible");
      },
    });
  
    $("a[data-toggle=\"tab\"]").click(function(e) {
      e.preventDefault();
      $(this).tab("show");
    });
  });
  
 
  $('#cedula').focus(function() {
    $('#success').html('');
  });
  