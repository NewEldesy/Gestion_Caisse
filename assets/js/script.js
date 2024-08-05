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

//Supprimer Utilisateurs
function supUsers() {
    $(document).on("click" , "#btn_del", function(e) {
        e.preventDefault();
        console.log('premier palier');

        if (window.confirm("Voulez-vous supprimer cet Utilisateurs ?")) {
            var id = $(this).attr("value");
            console.log(id);

            $.ajax({
                url:"delete_user.php",
                type:"post",
                data:{
                    id:id
                },
                success:function(data){
                    $("#msg_delete").html(data).delay(700).slideDown(700);
                    $("#msg_delete").delay(700).slideUp(700);
                    affUsers();
                }
            });
        } else {
            return false;
        }
    });
}
supUsers();

//Fonction qui modifier utilisateurs
function updateUsers()
{
    $(document).on("click" , "#btn_update" , function(e)
    {
        e.preventDefault();
        var mod_id = $(this).attr("value");
        
        $.ajax({
            url:"mod_user.php",
            type:"post",
            data:{
                mod_id:mod_id
            },
            success: function(data){
                $("#aff_form_mod").html(data);
            }
        });
    });
}
updateUsers();

//fonction de mise a jour utilisateur
function majUsers() {
    $(document).on("click" , "#btn_maj", function(e) {
        e.preventDefault();

        var id = $("#id_user").val();
        var nom = $("#nom").val();
        var prenom =$("#prenom").val();
        var email =$("#email").val();
        var btn_maj = $("#btn_maj").val();

        $.ajax({
            url:"update_user.php",
            type:"post",
            data:{
                id:id,
                nom:nom,
                prenom:prenom,
                email:email,
                btn_maj:btn_maj
            },
            success:function(data){
                $("#msg_maj").html(data).delay(700).slideDown(700);
                $("#msg_maj").delay(700).slideUp(700);
                affUsers();  
            }
        });
    });
}
majUsers();