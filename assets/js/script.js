//Remplir Reçu
document.addEventListener('DOMContentLoaded', function() {
    let tableauRecu = [];
    let selectedCard = null; // Variable pour stocker la carte sélectionnée
    const modalElement = document.getElementById('quantityModal');
    const modal = new bootstrap.Modal(modalElement);

    // Utiliser la délégation d'événements pour les éléments ajoutés dynamiquement
    document.body.addEventListener('click', function(event) {
        if (event.target.closest('.card')) {
            selectedCard = event.target.closest('.card'); // Stocker la carte sélectionnée
            modal.show(); // Afficher le modal
        }
    });

    document.getElementById('confirmQuantity').addEventListener('click', function() {
        let quantite = parseInt(document.getElementById('quantityInput').value);
        let titre = selectedCard.querySelector('.card-title').textContent;
        let prix = parseFloat(selectedCard.querySelector('.prix').textContent);

        let articleExiste = false;
        tableauRecu.forEach(function(item) {
            if (item.nom === titre) {
                item.quantite = quantite;
                articleExiste = true;
            }
        });

        if (!articleExiste) {
            tableauRecu.push({ nom: titre, prix: prix, quantite: quantite });
        }

        afficherRecu(tableauRecu);
        modal.hide(); // Masquer le modal
    });

    function afficherRecu(tableau) {
        let recuElement = document.getElementById('recu');
        recuElement.innerHTML = '';
        let total = 0;

        tableau.forEach(function(item, index) {
            recuElement.innerHTML += `<tr>
                <td>${item.nom}</td>
                <td>${item.quantite}</td>
                <td>${item.prix}</td>
                <td>${(item.prix * item.quantite)}</td>
                <td class="action-col"><button class="btn btn-danger btn-sm" onclick="supprimerArticle(${index})"><i class="fas fa-trash"></i></button></td>
            </tr>`;
            total += item.prix * item.quantite;
        });

        document.getElementById('total').textContent = total;
    }

    window.supprimerArticle = function(index) {
        tableauRecu.splice(index, 1);
        afficherRecu(tableauRecu);
    };
});

//Imprimer reçu
function print() {
    $(function(){
        $('#print').on('click', function(){
            $('.action-col').hide(); // colonne "Action" invisible avant impression
            $.print(".facture"); // Imprimer la facture
            $('.action-col').show(); // colonne "Action" visible après impression
        });
    });
}

//Reset Reçu
function resetTable() {
    $("#recu").empty(); // Vide le contenu du tableau
    $("#total").text("0"); // Réinitialise le total à zéro ou une autre valeur par défaut
}

//Afficher Produits à la caisse
$(document).ready(function() {
    // Charger tous les articles au chargement de la page
    loadItems(1);

    // Gérer le clic sur les boutons de catégorie avec la classe spécifique
    $('.cat-button').click(function() {
        var categoryId = $(this).data('category'); // Utiliser l'attribut data-category
        loadItems(categoryId);
    });

    // Fonction pour charger les articles en fonction de la catégorie
    function loadItems(categoryId) {
        $.ajax({
            url: 'getProduct.php',
            type: 'POST',
            data: { category_id: categoryId },
            success: function(response) {
                $('.item_cat').html(response);
            }
        });
    }
});

//Afficher Categorie
function affCats(){
    $.ajax({
        url: "read_cat.php",
        type: "post",
        success: function(data) {
            $("#affCat").html(data).delay(500).slideDown(500);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Erreur lors de la récupération des catégories :', textStatus, errorThrown);
            $("#affCat").html('<div class="alert alert-danger">Erreur lors du chargement des catégories.</div>');
        }
    });
}
affCats();

// Ajouter Categorie
$(document).on('click', '#btn_add_cat', function(e){
    console.log('Button clicked');
    e.preventDefault();
    var nom = $("#nom").val();

    if (nom.trim() !== "") { // Vérifier si le champ n'est pas vide
        $.ajax({
            url: "add_cat.php",
            type: "post",
            data: {nom: nom},
            success: function(data){
                $("#result_cat").html(data).delay(700).slideDown(700);
                affCats(); // Appel de la fonction pour mettre à jour les catégories
                $("#result_cat").delay(2000).slideUp(700);
            },
            error: function(){
                $("#result_cat").html('<div class="alert alert-danger">Erreur lors de l\'ajout de la catégorie.</div>');
            }
        });
        $("#frm_add_cat")[0].reset(); // Réinitialise le formulaire
        $('#exampleModalAdd').modal('hide'); // Ferme la modal après l'ajout
    } else {
        $("#result_cat").html('<div class="alert alert-warning">Le nom de la catégorie ne peut pas être vide.</div>');
    }
});

//Supprimer categorie
$(document).on('click', '.btn_del_cat', function(e){
    e.preventDefault();
    if (window.confirm("Voulez-vous supprimer cette catégorie ?")) {
        var id = $(this).data("id");

        $.ajax({
            url: "delete_cat.php",
            type: "post",
            data: { id: id },
            success: function(data) {
                $("#msg_delete_cat").html(data).delay(700).slideDown(700);
                $("#msg_delete_cat").delay(2000).slideUp(700);
                affCats(); // Recharge la liste des catégories après suppression
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Erreur lors de la suppression :', textStatus, errorThrown);
                $("#msg_delete_cat").html('<div class="alert alert-danger">Erreur lors de la suppression de la catégorie.</div>').delay(2000).slideUp(700);
            }
        });
    } else {
        return false;
    }
});

//Fonction qui modifier categorie
function updateCats()
{
    $(document).on("click" , "#btn_up_cat" , function(e)
    {
        e.preventDefault();
        var id = $(this).attr("value");
        
        $.ajax({
            url:"mod_cat.php",
            type:"post",
            data:{
                id:id
            },
            success: function(data){
                $("#aff_form_mod").html(data);
            }
        });
    });
}
updateCats();

//fonction de mise a jour categorie
function majCats() {
    $(document).on("click" , "#btn_maj_cat", function(e) {
        e.preventDefault();

        var id = $("#id").val();
        var nom = $("#nom").val();
        var btn_maj_cat = $("#btn_maj_cat").val();

        console.log("ID:", id);
        console.log("Nom:", nom);

        $.ajax({
            url:"update_cat.php",
            type:"post",
            data:{
                id:id,
                nom:nom,
                btn_maj_cat:btn_maj_cat
            },
            success:function(data){
                $("#msg_maj_cat").html(data).delay(700).slideDown(700);
                $("#msg_maj_cat").delay(700).slideUp(700);
                affCats();  
            }
        });
    });
}
majCats();

//Afficher Produits
function affProds(){
    $.ajax({
        url: "read_product.php",
        type: "post",
        success: function(data) {
            $("#affProd").html(data).delay(500).slideDown(500);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Erreur lors de la récupération des catégories :', textStatus, errorThrown);
            $("#affProd").html('<div class="alert alert-danger">Erreur lors du chargement des catégories.</div>');
        }
    });
}
affProds();

// Ajouter Produits
$(document).on('click', '#btn_add_prod', function(e) {
    e.preventDefault();

    var nom = $("#nom").val();
    var prix = $("#prix").val();
    var categorie_id = $("#categorie_id").val();
    var img = $("#img")[0].files[0]; // Récupère le fichier sélectionné

    if (nom.trim() !== "" && prix.trim() !== "" && img) { // Vérifier si les champs ne sont pas vides
        var formData = new FormData();
        formData.append('nom', nom);
        formData.append('prix', prix);
        formData.append('categorie_id', categorie_id);
        formData.append('img', img);

        $.ajax({
            url: "add_product.php",
            type: "post",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#result_prod").html(data).delay(700).slideDown(700);
                affProds(); // Appel de la fonction pour mettre à jour la liste des produits
                $("#result_prod").delay(2000).slideUp(700);
            },
            error: function() {
                $("#result_prod").html('<div class="alert alert-danger">Erreur lors de l\'ajout du produit.</div>');
            }
        });
        $("#frm_add_prod")[0].reset(); // Réinitialise le formulaire
        $('#exampleModalAdd').modal('hide'); // Ferme la modal après l'ajout
    } else {
        $("#result_prod").html('<div class="alert alert-warning">Veuillez remplir tous les champs.</div>');
    }
});

//Supprimer Produits
$(document).on('click', '.btn_del_prod', function(e){
    e.preventDefault();
    if (window.confirm("Voulez-vous supprimer ce produit ?")) {
        var id = $(this).data("id");

        $.ajax({
            url: "delete_product.php",
            type: "post",
            data: { id: id },
            success: function(data) {
                $("#msg_delete_prod").html(data).delay(700).slideDown(700);
                $("#msg_delete_prod").delay(2000).slideUp(700);
                affProds(); // Recharge la liste des catégories après suppression
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Erreur lors de la suppression :', textStatus, errorThrown);
                $("#msg_delete_prod").html('<div class="alert alert-danger">Erreur lors de la suppression du produit.</div>').delay(2000).slideUp(700);
            }
        });
    } else {
        return false;
    }
});

//Fonction qui modifier produit
function updateProds()
{
    $(document).on("click" , "#btn_up_prod" , function(e)
    {
        e.preventDefault();
        var id = $(this).attr("value");
        
        $.ajax({
            url:"mod_prod.php",
            type:"post",
            data:{
                id:id
            },
            success: function(data){
                $("#aff_form_mod").html(data);
            }
        });
    });
}
updateProds();

function majProds() {
    $(document).on('click', '#btn_maj_prod', function(e) {
        e.preventDefault();
    
        var id = $("#id").val(); // Ajoutez un champ caché pour l'identifiant du produit
        var nom = $("#nom").val();
        var prix = $("#prix").val();
        var categorie_id = $("#categorie_id").val();
        var img = $("#img")[0].files[0]; // Récupère le fichier sélectionné
    
        if (nom.trim() !== "" && prix.trim() !== "" && (img || !img)) { // Vérifie les champs
            var formData = new FormData();
            formData.append('id', id); // Ajoutez l'identifiant du produit
            formData.append('nom', nom);
            formData.append('prix', prix);
            formData.append('categorie_id', categorie_id);
            if (img) {
                formData.append('img', img);
            } else {
                formData.append('current_img', $("#current_img").val()); // Assurez-vous d'ajouter un champ caché pour l'image actuelle
            }
    
            $.ajax({
                url: "update_product.php",
                type: "post",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#msg_maj_prod").html(data).delay(700).slideDown(700);
                    $("#msg_maj_prod").delay(2000).slideUp(700);
                    affProds();
                },
                error: function() {
                    $("#msg_maj_prod").html('<div class="alert alert-danger">Erreur lors de la mise à jour du produit.</div>');
                }
            });
            $('#exampleModalMaj').modal('hide');
        } else {
            $("#msg_maj_prod").html('<div class="alert alert-warning">Veuillez remplir tous les champs.</div>');
        }
    });
}
majProds();

// Enregistrement de la transaction
$(document).ready(function() {
    $('#print').on('click', function() {
        saveData();
    });
});

function saveData() {
    // Récupérer les informations de la facture
    var date = $('#date').text();
    var transaction_id = $('#transaction_id').text();
    var total = $('#total').text();
    var items = [];
    var statuts = 'payé'; // Notez que j'ai corrigé "statuts" en "statuts" pour être cohérent avec le code PHP

    $('#recu tr').each(function() {
        var item = {
            id: $(this).find('td:eq(0)').text(), // ID du produit dans la première colonne
            qty: $(this).find('td:eq(1)').text(), // Quantité dans la deuxième colonne
            pu: $(this).find('td:eq(2)').text(), // Prix unitaire dans la troisième colonne
            total: $(this).find('td:eq(3)').text() // Total dans la quatrième colonne
        };
        items.push(item);
    });
    
    $.ajax({
        url: 'save_transaction.php',
        method: 'POST',
        data: {
            date: date,
            transaction_id: transaction_id,
            total: total,
            statuts: statuts, // Assurez-vous que le nom correspond à celui utilisé dans le code PHP
            items: JSON.stringify(items) // Convertir le tableau en JSON
        },
        success: function(response) {
            print();
            lastId();
        },
        error: function(xhr, status, error) {
            console.error('Erreur AJAX:', error);
            alert('Erreur lors de l\'enregistrement de la facture.');
        }
    });
}

//Get Receipt Number
function lastId() {
    $(document).ready(function() {
        $.ajax({
            url: 'getLastTransactionId.php', // URL du script PHP
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#transaction_id').text(response.last_id);
                    $('#date').text(new Date().toLocaleString());
                } else {
                    $('#error').text('Erreur: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX error:", status, error); // Affiche les erreurs AJAX dans la console
                $('#error').text('Erreur AJAX: ' + error);
            }
        });
    });
}
lastId();