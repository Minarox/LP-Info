const form = getId('login_form')

getId('login').addEventListener('click', function (event) {

    event.preventDefault();
    const formData = new FormData(form)
    postData(formData, '/ajax/loginSystem').catch(error => {
        console.log('Error :', error)
    })
})

async function postData(formData, url) {
    const init = {
        method: 'POST',
        body: formData,
    }

    const response = await fetch(url, init)

    loginSystem(await response.json())
}

function loginSystem(data) {
    if (data.success === true) {
        window.location.href = '/'
        return false
    }

    getId('error_messages').innerHTML = ''

    for (const key in data.message) {
        if (data.message.hasOwnProperty(key)) {
            for (const key2 in data.message[key]) {
                if (data.message[key].hasOwnProperty(key2)) {
                    getId('error_messages').innerHTML += `<p>${data.message[key][key2]}</p>`
                }
            }
        }
    }
}