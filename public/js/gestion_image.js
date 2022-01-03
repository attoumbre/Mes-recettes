function ajouterFichier(files) {
    if (files.length > 0) {
        var imageType = /^image\//;
        var file = files[0];

        if (!imageType.test(file.type)) {
            alert("Veuillez sélectionner une image");
            supprimerImage();
        } else {
            preview.innerHTML = '';
            var img = document.createElement("img");
            img.setAttribute('id', 'image');
            img.classList.add("img-fluid");
            img.classList.add("mb-4");
            img.file = file;

            preview.appendChild(img);
            var reader = new FileReader();

            reader.onload = (function (aImg) {
                return function (e) {
                    aImg.src = e.target.result;
                };
            })(img);

            reader.readAsDataURL(file);
            document.getElementById("btn_supp_image").style.display = 'initial';
        }
    } else {
        supprimerImage();
    }
};

function supprimerImage() {
    document.getElementById("image").src = '';
    input_file.innerHTML = '';
    const div = document.createElement('div');
    div.innerHTML = `
    <span class="font-family_montserrat-semibold font-size-10px text-dark text-uppercase">Ajouter une image :</span>
    <br><br>
    <input class="form-control" type="file" id="file" name="file" onchange="ajouterFichier(files)" />
    <br>
    <button type="button" class="btn btn-danger" id="btn_supp_image" onclick="supprimerImage()" style="display:none">Supprimer l'image</button>
  `;
    document.getElementById('input_file').appendChild(div);
}

function supprimerAncienneImage() {
    document.getElementById('etat_ancienne_image').value = "absente";
}