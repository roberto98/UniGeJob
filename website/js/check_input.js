
var firstname_ok = false;
var lastname_ok = false;
var email_ok = false;
var pass_ok = false;

$(document).ready(function() {
  // -------------------------- Regex -------------------------- //
      var regex_name = /^([a-zA-Z]{1,16})$/ ;
      var regex_email = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i;
      var regex_pass = /^[a-zA-Z0-9]{1,16}$/;
      var password = "";

// ---------------------------- Nome ---------------------------- //
      $("#firstname").keyup(function() {
      	var input=$("#firstname").val();

      	if(input.match(regex_name)){
          $("#firstname").closest("li").css('border', '2px solid green');
          $("#display_firstname").html("");
          firstname_ok=true;
        }
      	else{
          $("#firstname").closest("li").css('border', '2px solid red');
          $("#display_firstname").html("Il nome può contenere solo lettere");
          firstname_ok=false;
        }
      });
// ------------------------------- Cognome ---------------------------- //
      $("#lastname").keyup(function() {
        var input=$("#lastname").val();

        if(input.match(regex_name)){
          $("#lastname").closest("li").css('border', '2px solid green');
          $("#display_lastname").html("");
          lastname_ok=true;
        }
        else{
          $("#lastname").closest("li").css('border', '2px solid red');
          $("#display_lastname").html("Il cognome può contenere solo lettere");
          lastname_ok=false;
        }
      });
// ---------------------------------- Email ---------------------------------- //
      $("#email").keyup(function() {
        var input=$("#email").val();

        if(input.match(regex_email)){
          $("#email").closest("li").css('border', '2px solid green');
          $("#display_email").html("");
          email_ok=true;
        }
        else{
          $("#email").closest("li").css('border', '2px solid red');
          $("#display_email").html("Email non valida");
          email_ok=false;
        }
      });

// ---------------------------------- Password ---------------------------------- //
      $("#pass").keyup(function() {
        var input=$("#pass").val();

        if(input.match(regex_pass)){
          $("#pass").closest("li").css('border', '2px solid green');
          $("#display_password").html("");
          password = input;
          pass_ok=true;
        }
        else{
          $("#pass").closest("li").css('border', '2px solid red');
          $("#display_password").html("La password può contenere solo lettere e numeri");
          pass_ok=false;
        }
      });

// ------------------------------------- Confirm ---------------------------------- //
      $("#confirm").keyup(function() {
        var input=$("#confirm").val();

        if(input == password){
          $("#confirm").closest("li").css('border', '2px solid green');
          $("#display_confirm").html("");
          confirm_ok=true;
        }
        else{
          $("#confirm").closest("li").css('border', '2px solid red');
          $("#display_confirm").html("La password non corrisponde");
          confirm_ok=false;
        }
      });

      $("#contratto").click(function(){
        if($("#contratto").val() == "true")
          $("#contratto").val("false");
        else
          $("#contratto").val("true");


      });

});

// --------------------------- Mando i dati se ci sono tutti -------------------- //

function check_input_signin() {

    if (firstname_ok && lastname_ok && email_ok && pass_ok && confirm_ok) {
      $("#display_all").html("");
          if($('#contratto').val() == "false") {  //false è il value che gli passo in html
              $("#display_contratto").html("Devi accettare per proseguire");
            return false;
          } else {
              $("#display_contratto").html("");
              return true;
          }
    } else {
    $("#display_all").html("Devi prima inserire tutti i dati corretti");
    return false;
  }

}


function check_input_signUp(){
  if (email_ok && pass_ok) {
      $("#display_all").html("");
      return true;
  } else {
      $("#display_all").html("L'email o la password non rispettano i requisiti");
      return false;
    }

}
