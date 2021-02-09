/*
const form = getId('signUp_form')

getId('signUp').addEventListener('click', function (event) {

    event.preventDefault();
    const formData = new FormData(form);
    postData(formData, '/ajax/signUpSystem', 1).then(data => {
        console.log(data)
    })
})

async function postData(formData, url, callingFunc) {
    const init = {
        method: 'POST',
        body: formData,
    }

    const response = await fetch(url, init)

    switch (callingFunc) {
        case 1:
            signUpSystem(await response.json())
            break
    }
}

function signUpSystem(data) {
    console.log(data)
}*/
