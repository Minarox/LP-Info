const form = getId('login_form');

getId('login').addEventListener('click', function (event) {

    event.preventDefault();
    const formData = new FormData(form);
    postData(formData, '/ajax/connexionSystem', 1);
});

async function postData(formData, url, callingFunc) {

    const init = {
        method: 'POST',
        body: formData,
    };

    const response = await fetch(url, init);

    switch (callingFunc) {
        case 1:
            loginSystem(JSON.parse(await response.text()));
            break;
    }

};

function loginSystem(data) {
    if (data.success === true) {
        window.location.href = '/';
        return false;
    }

    getId('error_messsages').innerHTML = '';

    for (const [key, value] of Object.entries(data.message)) {
        for (const [key2, value2] of Object.entries(value)) {
            getId('error_messsages').innerHTML += `<p>${value2}</p>`;
        }
    }
}

function getId(id) {
    return document.getElementById(id);
}

// Just to display 'mot de passe oublié ?'
function show() {
    getId("overlay").style.display = "block";
}

function hide() {
    getId("overlay").style.display = "none";
}