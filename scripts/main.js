(function(){
    $(".burgerMenu").on("click", function(ev) 
    {
        ev.preventDefault();
        $(this).toggleClass("animateBurger");
        $(".mainNav").slideToggle("fast");
    });
    
    $(window).on("resize", function(ev) {
        //console.info(window.innerWidth);
        if (window.innerWidth > 800) {
        $("nav ul").attr("style", "");
        }
    });

    function navHighlight(elem, home, active) {
        var url = location.href.split('/'),
            loc = url[url.length -1],
            link = document.querySelectorAll(elem);
        for (var i = 0; i < link.length; i++) {
            var path = link[i].href.split('/'),
                page = path[path.length -1];
            if (page == loc || page == home && loc == '') {
                link[i].parentNode.className += ' ' + active;
                document.body.className += ' ' + page.substr(0, page.lastIndexOf('.'));
                }
            }
        }
    navHighlight('.mainNav ul li a', 'index.html', 'current'); /* menu link selector, home page, highlight class */
    }
)();

function OpenRows(clickedRow)//rows id passed in from database management.php
{
    var elements = document.querySelectorAll(".tableRowButton,.tableRow");

    for(var i = 0;i < elements.length ;i++)
    {
        if(clickedRow == elements[i].id)
        {
            elements.item(i).classList.toggle("hidden");

        }
            
    }
    
}

$('input').on('keypress', function (event) {
    var newInput = new RegExp("^[a-zA-Z0-9 !@$.?,+]"); // white listed characters
        /*
    var r = [/0-9/, /a-z/, /A-Z/]; // Test if password contains one uppercase, lowercase and number
    var goodPass = r.every(function (testPass) { return r.testPass(newInput); }); // TODO
        */ 
    var checkSymbl = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!newInput.test(checkSymbl)) { // & testPass(newInput = TRUE)
       console.info("invalid character input");
       event.preventDefault();
       return false;
    }
    
});


var checkPasswordsMatch = function() 
{
    var user;
    var pass = document.getElementById('password');
    var passConfirm = document.getElementById('confirm_password');
    var key = document.getElementById('signUpKey');

    if (pass.value == passConfirm.value) 
    {
        pass.style.borderColor = 'green';
        passConfirm.style.borderColor = 'green';
        document.getElementById("signUpSubmit").disabled = false;
    }
    else if(user.value == "" && pass.value == "" && user.value == "" && user.value == "")
    {
        document.getElementById("signUpSubmit").disabled = true;

    }
    else
    {
        document.getElementById('password').style.borderColor = 'red';
        document.getElementById('confirm_password').style.borderColor = 'red';
        document.getElementById("signUpSubmit").disabled = true;

    }
};




var checkPasswordsMatchReset = function() 
{
    
    var pass = document.getElementById('password');
    var passConfirm = document.getElementById('confirm_password');

    if (pass.value == passConfirm.value) 
    {
        pass.style.borderColor = 'green';
        passConfirm.style.borderColor = 'green';
        document.getElementById("signUpSubmit").disabled = false;
    }
    else if(pass.value == "" || passConfirm.value == "")
    {
        document.getElementById("signUpSubmit").disabled = true;

    }
    else
    {
        document.getElementById('password').style.borderColor = 'red';
        document.getElementById('confirm_password').style.borderColor = 'red';
        document.getElementById("signUpSubmit").disabled = true;

    }
};


function copyToClipboard(text) 
{
    console.info("copy function");
    console.info(text);

    var dummy = document.createElement("textarea");
    document.body.appendChild(dummy);
    dummy.value = text;
    dummy.select();
    document.execCommand("copy");
    document.body.removeChild(dummy); 
};