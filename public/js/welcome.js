$(document).ready(function(){
    $('.menu_tab li:first-child').click(function(){
      // $('.home_contain').removeClass('d-none');
      $('.about_contain').removeClass('d-none');
      $('.login_contain').addClass('d-none');
      $('.join_contain').addClass('d-none');
    })
    $('.menu_tab li:nth-child(2)').click(function(){
      // $('.home_contain').addClass('d-none');
      $('.about_contain').addClass('d-none');
      $('.login_contain').removeClass('d-none');
      $('.join_contain').addClass('d-none');
    })
    $('.menu_tab li:nth-child(3)').click(function(){
      // $('.home_contain').addClass('d-none');
      $('.about_contain').removeClass('d-block').addClass('d-none');
      $('.login_contain').removeClass('d-block').addClass('d-none');
      $('.join_contain').removeClass('d-none');
    })
 
  });

$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    });

$(document).ready(function(){
    $('#email').change(function(){
        
      var email=  $('#email').val();
      var _token = $('input[name="_token"]').val();
  
 if (validateEmail(email)) {
    $.ajax({
    url:"/test/email",
    method:"POST",
    data:{email:email,_token:_token},
    success:function(result)
    {
     
     if(result==1){
         $('#email').css("border", "1px solid red"); 
         $('.email_mis').removeClass("d-none").addClass("d-block");
         $('.email_mis').text("(email id already taken)");
         $('#email').val(''); 
     }else{
         $('.email_mis').removeClass("d-block").addClass("d-none");
          $('#email').css("border", ""); 
          $('.email_mis').text("");
     }
    
    }

   });
 
 
 
  } else {
   
      $('#email').css("border", "1px solid red"); 
         $('.email_mis').removeClass("d-none").addClass("d-block");
         $('.email_mis').text("(In valid Email)");
         $('#email').val(''); 
   
   
  }
      
        
    });
    
});

 function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}


 function enterpassword(pas){
        
        var p=pas.value;
        //alert(p);
                errors = [];
    if (p.length < 6) {
        errors.push("Your password must be at least 6 characters");
         $('.mis_pass').removeClass("d-none").addClass("d-block");
         $('.mis_pass').text("Your password must be at least 6 characters");
         
         $('#password').css("border", "1px solid red");
    }
    if (p.search(/[a-z]/) < 0) {
        errors.push("Your password must contain at least one letter in lower case."); 
        $('.mis_pass').removeClass("d-none").addClass("d-block");
        $('.mis_pass').text("Your password must contain at least one letter in lower case.");
         $('#password').css("border", "1px solid red");
    }
     if (p.search(/[A-Z]/) < 0) {
        errors.push("Your password must contain at least one letter in upper case."); 
        $('.mis_pass').removeClass("d-none").addClass("d-block");
         $('.mis_pass').text("Your password must contain at least one letter in upper case.");
          $('#password').css("border", "1px solid red");
    }
      if (p.search(/[!@#$%^&*+-]/) < 0) {
        errors.push("Your password must contain at least one special character."); 
        $('.mis_pass').removeClass("d-none").addClass("d-block");
        $('.mis_pass').text("Your password must contain at least one special character.");
         $('#password').css("border", "1px solid red");
    }
    if (p.search(/[0-9]/) < 0) {
        $('.mis_pass').removeClass("d-none").addClass("d-block");
        $('.mis_pass').text("Your password must contain at least one digit.");
        errors.push("Your password must contain at least one digit.");
         $('#password').css("border", "1px solid red");
    }
    if (errors.length > 0) {
       // alert(errors.join("\n"));
       $('.mis_pass').removeClass("d-none").addClass("d-block");
             return false;
    }else{
        $('.mis_pass').removeClass("d-block").addClass("d-none");
        $('.mis_pass').hide();
        
        $('#password').css('border','');
         return true;
    }
    }


     $(document).ready(function(){
      $('#publisher_id').change(function(){
         var pub_id=$(this).val();

        if(pub_id != '')
  {
  
   var _token = $('input[name="_token"]').val();
   $.ajax({
    url:"/accesscode/fetch2",
    method:"POST",
    data:{p_id:pub_id, _token:_token},
    success:function(result)
    {
     $('#access_code').html(result);
    }

   });
  }

      });

  });