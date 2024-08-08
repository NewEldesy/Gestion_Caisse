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
    $('.action-col').hide(); // colonne "Action" invisible avant impression
    $.print(".facture"); // Imprimer la facture
    $('.action-col').show(); // colonne "Action" visible après impression
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


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////// START CATEGORIE ////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

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
                affCats();
                $("#result_cat").delay(2000).slideUp(700);
            },
            error: function(){
                $("#result_cat").html('<div class="alert alert-danger">Erreur lors de l\'ajout de la catégorie.</div>');
            }
        });
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
                affCats();
                $("#msg_delete_cat").delay(2000).slideUp(700);
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
        e.preventDefault(); var id = $(this).attr("value");
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
        var id = $("#id").val(); var nom = $("#nom").val();
        var btn_maj_cat = $("#btn_maj_cat").val();
        $.ajax({
            url:"update_cat.php",
            type:"post",
            data:{
                id:id, nom:nom,
                btn_maj_cat:btn_maj_cat
            },
            success:function(data){
                $("#msg_maj_cat").html(data).delay(700).slideDown(700);
                affCats();
                $("#msg_maj_cat").delay(700).slideUp(700);  
            }
        });
    });
}
majCats();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////// END CATEGORIE /////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////// START PRODUIT /////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Afficher Produits
function affProds(){
    $.ajax({
        url: "read_product.php",
        type: "post",
        success: function(data) {
            $("#affProd").html(data).delay(500).slideDown(500);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Erreur lors de la récupération des produits :', textStatus, errorThrown);
            $("#affProd").html('<div class="alert alert-danger">Erreur lors du chargement des produits.</div>');
        }
    });
}
affProds();

// Ajouter Produits
$(document).on('click', '#btn_add_prod', function(e) {
    e.preventDefault();
    var nom = $("#nom").val(); var prix = $("#prix").val();
    var categorie_id = $("#categorie_id").val();
    var img = $("#img")[0].files[0];
    // Vérifier si les champs ne sont pas vides
    if (nom.trim() !== "" && prix.trim() !== "" && img) {
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
                affProds();
                $("#result_prod").delay(2000).slideUp(700);
            },
            error: function() {
                $("#result_prod").html('<div class="alert alert-danger">Erreur lors de l\'ajout du produit.</div>');
            }
        });
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
    } else { return false; }
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
            data:{ id:id },
            success: function(data){
                $("#aff_form_mod").html(data);
            }
        });
    });
}
updateProds();
// function MAJ Produit
function majProds() {
    $(document).on('click', '#btn_maj_prod', function(e) {
        e.preventDefault();
        var id = $("#id").val(); var nom = $("#nom").val();
        var prix = $("#prix").val(); var categorie_id = $("#categorie_id").val();
        var img = $("#img")[0].files[0]; // Récupère le fichier sélectionné
        // Vérifie les champs
        if (nom.trim() !== "" && prix.trim() !== "" && (img || !img)) {
            var formData = new FormData();
            formData.append('id', id); formData.append('nom', nom);
            formData.append('prix', prix); formData.append('categorie_id', categorie_id);
            if (img) { formData.append('img', img);
            } else { formData.append('current_img', $("#current_img").val());}
            $.ajax({
                url: "update_product.php",
                type: "post",
                data: formData,
                contentType: false, processData: false,
                success: function(data) {
                    $("#msg_maj_prod").html(data).delay(700).slideDown(700);
                    affProds();
                    $("#msg_maj_prod").delay(2000).slideUp(700);
                },
                error: function() { $("#msg_maj_prod").html('<div class="alert alert-danger">Erreur lors de la mise à jour du produit.</div>'); }
            });
            $('#exampleModalMaj').modal('hide');
        } else { $("#msg_maj_prod").html('<div class="alert alert-warning">Veuillez remplir tous les champs.</div>'); }
    });
}
majProds();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////// END PRODUIT //////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function clearTableBody() {
    document.getElementById('recu').innerHTML = ''; document.getElementById('total').innerHTML = '';
}
// Enregistrement de la transaction
$(document).ready(function() {
    $('#print').on('click', function() {
        // Montrer l'indicateur de chargement
        $('#loading').show();
        $('#print').prop('disabled', true);
        // Récupérer les informations de la facture
        var date = $('#date').text(); var transaction_id = $('#transaction_id').text();
        var total = $('#total').text(); var items = []; var statuts = 'payé';

        $('#recu tr').each(function() {
            var item = {
                id: $(this).find('td:eq(0)').text(), qty: $(this).find('td:eq(1)').text(),
                pu: $(this).find('td:eq(2)').text(), total: $(this).find('td:eq(3)').text()
            };
            items.push(item);
        });
        // Vérifier s'il y a des articles ou un total à 0
        if ($.trim(total) === '' && items.length === 0) {
            alert('Aucune vente en cours');
            $('#loading').hide(); // Cacher l'indicateur si aucune vente
            $('#print').prop('disabled', false); // Réactiver le bouton
            return; // Arrêter l'exécution si aucune vente
        } else { // Envoyer la requête AJAX pour enregistrer la transaction
            $.ajax({
                url: 'save_transaction.php',
                method: 'POST',
                data: {
                    date: date, transaction_id: transaction_id,
                    total: total, statuts: statuts,
                    items: JSON.stringify(items)
                },
                success: function(response) {
                    $("#msg_print").html(response).delay(700).slideDown(700);
                    $("#msg_print").delay(2000).slideUp(700);
                    // Utiliser un timeout pour donner un peu de temps à la mise à jour du DOM avant d'imprimer
                    setTimeout(function() {
                        print(); lastId(); clearTableBody();
                    }, 100); // 100 millisecondes d'attente
                },
                error: function(xhr, status, error) {
                    console.error('Erreur AJAX:', error);
                    alert('Erreur lors de l\'enregistrement du reçu.');
                },
                complete: function() {
                    // Cacher l'indicateur de chargement et réactiver le bouton après la requête
                    $('#loading').hide(); $('#print').prop('disabled', false);
                }
            });
        }
    });
});
//Afficher le numéro de reçu en cours
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
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////// START TRANSACTION ///////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Afficher Transactions
function affTs(){
    $.ajax({
        url: "read_transaction.php",
        type: "post",
        success: function(data) {
            $("#affTransactions").html(data).delay(500).slideDown(500);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Erreur lors de la récupération des transactions :', textStatus, errorThrown);
            $("#affTransactions").html('<div class="alert alert-danger">Erreur lors du chargement des transactions.</div>');
        }
    });
}
affTs();
//Afficher Formulaire pour modifier une transactions
function updateTs() {
    $(document).on("click", "#btn_up_t", function(e) {
        e.preventDefault();
        var id = $(this).data("id"); // Use data attribute

        if (!id) {
            console.error("ID is not defined.");
            return;
        }

        $.ajax({
            url: "mod_transaction.php",
            type: "post",
            data: { id: id },
            success: function(data) {
                $("#aff_form_t").html(data);
            },
            error: function(xhr, status, error) {
                console.error("AJAX error: " + status + " - " + error);
                // Optionally, handle the error by displaying a message to the user
            }
        });
    });
}
updateTs();
//fonction de mise a jour transaction
function majTs() {
    $(document).on("click" , "#btn_maj_t", function(e) {
        e.preventDefault();
        var id = $("#id").val(); var statuts = $("#statuts").val();
        var btn_maj_t = $("#btn_maj_t").val();
        $.ajax({
            url:"update_transaction.php",
            type:"post",
            data:{
                id:id, statuts:statuts,
                btn_maj_t:btn_maj_t
            },
            success:function(data){
                $("#msg_maj_t").html(data).delay(700).slideDown(700);
                affTs(); updateTransactionTotals();
                $("#msg_maj_t").delay(700).slideUp(700);
            }
        });
    });
}
majTs();
//fonction d'affichage du total des ventes
function updateTransactionTotals() {
    $.ajax({
        url: 'get_totals.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#t_total').text(Number(data.total).toFixed(2)); $('#t_today').text(Number(data.today).toFixed(2));
            $('#t_week').text(Number(data.week).toFixed(2)); $('#t_month').text(Number(data.month).toFixed(2));
            $('#t_year').text(Number(data.year).toFixed(2));
        },
        error: function(xhr, status, error) {
            console.error('Erreur Ajax:', status, error);
        }
    });
}
updateTransactionTotals();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////// END TRANSACTION ////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////