$(document).ready(function(){
    console.log('document is ready');
    let cart = document.querySelector("#shop-cart")
    let cartTab = document.querySelector("#cartTab")
    let tab1 = document.querySelector("#homeTab")
    let tab2 = document.querySelector("#storeTab")
    let tab3 = document.querySelector("#aboutTab")
    let view1 = document.querySelector("#home")
    let view2 = document.querySelector("#menu")
    let view3 = document.querySelector("#about")
    let clickButton = document.querySelector("#confirm_order");
    let fileInput = document.querySelector("#receipt_image");
    let otp_btn = $('#request_otp');    
    
    $('.pass_show').append('<span class="ptxt">Show</span>');  
    
    function clickTab(x){    
    
        if (x == 1) {
            cart.classList.remove("active")
            cartTab.classList.remove("active")
            console.log('clicktab x ==1');
        } else if (x == 0) {
            cart.classList.add("active")
            cartTab.classList.add("active")
            tab1.classList.remove("active")
            tab2.classList.remove("active")
            tab3.classList.remove("active")
            view1.classList.remove("active")
            view2.classList.remove("active")
            view3.classList.remove("active")
        }
    }    

    function isEmpty(value) {
        return (value == null || (typeof value === "string" && value.trim().length === 0));
    }

      fileInput.addEventListener("change", function () {
         
         // check if the file is selected or not
         if (fileInput.files.length == 0) {
            console.log('file is empty');
            clickButton.disabled = true;
            clickButton.opacity = 0.3;
         } else {
            console.log('file is not empty');
            clickButton.disabled = false;
            clickButton.style.opacity = 1;
         }
      });

      otp_btn.click(function() {
        // Clear any existing timer
        disabledButton();
        alert('otp clicked');
      });

      function disabledButton(){
        document.getElementById("request_otp").disabled = true;
      }
      
});

$(document).on('click','.pass_show .ptxt', function(){ 
    $(this).text($(this).text() == "Show" ? "Hide" : "Show"); 
    $(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; }); 
});  



