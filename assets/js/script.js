 $(document).ready(function () {

    
    var wrapper = document.getElementsByClassName("text-animation")[0];
    wrapper.style.opacity="1";
    wrapper.innerHTML = wrapper.textContent.replace(/./g,"<span>$&</span>");

    var spans = wrapper.getElementsByTagName("span");

    for(var i=0;i<spans.length;i++){
        spans[i].style.animationDelay = i*20+"ms";
    }  




    $('#thank-you').hide();
    $('#contact').submit(function(){
        $.ajax({
        type: 'POST',
        url: 'estimate.php',
        data: $(this).serialize() // getting filed value in serialize form
        })
        .done(function(data){
          console.log(data); // if getting done then call.
        $('#estimate-form').replaceWith($('#thank-you').html());

        })
        .fail(function() { // if fail then getting message
        // just in case posting your form failed
        alert( "Posting failed." );

        });
        // to prevent refreshing the whole page page
        return false;
    });




  
});