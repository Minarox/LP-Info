// Function to get the Id
function getId(id) {
    return document.getElementById(id);
}

function show() {
    getId('overlay').style.display = "block";

}
function hide() {
    getId('overlay').style.display = "none";
}

function showMyImage(fileInput) {
    const files = fileInput.files;

    for (let i = 0; i < files.length; i++) {
        const file = files[i];

        if (!file.type.match(/image.*/)) continue;

        getId('profil-picture').style.border = '3px solid green';
        const img = getId('profil-picture');
        img.file = file;

        const reader = new FileReader();

        reader.onload = (function(aImg) {
            return function(event) {
                aImg.src = event.target.result;
            };
        })(img);

        reader.readAsDataURL(file);
    }
}