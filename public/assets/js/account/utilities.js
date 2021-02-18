// Function to get the Id
function getId(id) {
    return document.getElementById(id);
}

if (getId('alert')) {
    setTimeout(hideAlert,3500);
}

function show() {
    getId('overlay').style.display = "block";

}
function hide() {
    getId('overlay').style.display = "none";
}

function hideAlert() {
    getId("alert").classList.add("hide-alert");
}

// A garder !! Pour l'Ajax

// // Ajax call
// async function postData(formData, url) {
//     const init = {
//         method: 'POST',
//         body: formData,
//     }
//
//     const response = await fetch(url, init)
//     AuthSystem(await response.json())
// }
//
// function AuthSystem(data) {
//     // debug
//     console.log(data)
//
//     if (data.success === true) {
//         window.location.href = '/'
//         return false
//     }
//
//     getId('error_messages').innerHTML = ''
//
//     for (const key in data.message) {
//         if (data.message.hasOwnProperty(key)) {
//             for (const key2 in data.message[key]) {
//                 if (data.message[key].hasOwnProperty(key2)) {
//                     getId('error_messages').innerHTML += `<p>${data.message[key][key2]}</p>`
//                 }
//             }
//         }
//     }
// }