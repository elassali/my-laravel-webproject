$(document).ready(function(){
 
    $('#btn_login_details').click(function(){
     
   
      $('#list_login_details').removeClass('active active_tab1');
      $('#list_login_details').removeAttr('href data-toggle');
      $('#login_details').removeClass('active');
      $('#list_login_details').addClass('inactive_tab1');
      $('#list_contact_details').removeClass('inactive_tab1');
      $('#list_contact_details').addClass('active_tab1 active');
      $('#list_contact_details').attr('href', '#personal_details');
      $('#list_contact_details').attr('data-toggle', 'tab');
      $('#contact_details').addClass('active in');
     
    });
    
    $('#previous_btn_contact_details').click(function(){
      
     $('#list_contact_details').removeClass('active active_tab1');
     $('#list_contact_details').removeAttr('href data-toggle');
     $('#contact_details').removeClass('active in');
     $('#list_contact_details').addClass('inactive_tab1');
     $('#list_login_details').removeClass('inactive_tab1');
     $('#list_login_details').addClass('active_tab1 active');
     $('#list_login_details').attr('href', '#login_details');
     $('#list_login_details').attr('data-toggle', 'tab');
     $('#login_details').addClass('active');
    });
    
   });