function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}


function registerValidator() {
    var name = document.getElementById('username2').value;
    var email = document.getElementById('email2').value;

    var namechecker = /^[a-zA-Z ]+$/;
    if(!name.match(namechecker))
    {
        alert("Name field should have only alphabets");
        return false;
    }
    if (!validateEmail(email)) {
        alert('Email is not valid');
        return false;
    }

}


function profileValidator() {
    var name = document.getElementById('name').value;
    var from = document.getElementById('from').value;
    var to = document.getElementById('to').value;

    var namechecker = /^[a-zA-Z ]+$/;
    if(!name.match(namechecker))
    {
        alert("Name field should have only alphabets");
        return false;
    }

    if(!from.match(namechecker))
    {
        alert("Travelling From field should have only alphabets");
        return false;
    }

    if(!to.match(namechecker))
    {
        alert("Travelling To field should have only alphabets");
        return false;
    }

}

function bookingValidator() {
    var first = document.getElementById('first').value;
    var last = document.getElementById('last').value;

    var namechecker = /^[a-zA-Z ]+$/;
    if(!first.match(namechecker))
    {
        alert("First Name field should have only alphabets");
        return false;
    }

    if(!last.match(namechecker))
    {
        alert("Last Name field should have only alphabets");
        return false;
    }


}