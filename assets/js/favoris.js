let btnFavoris = document.querySelectorAll('.btn-favoris');

btnFavoris.forEach(btn => {
    //AJAX : btn envoye au controleur la recette mis en favoris
    btn.addEventListener('click', function () {
        //Récupère l'id dans data-recette
        const recetteId = btn.dataset.recette;
       
        const isActive = btn.classList.contains('active');
        const action = isActive ? 'remove' : 'add';

        const data = `id_recette=${recetteId}&action=${action}`;

        //Fetch qui envoie une requête POST au controleur avec l'id de la recette et l'action
        fetch('../controleurs/favoris.php',
            {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' },
                body: data
            })
            .then(response => response.json())
            .then(result => {
                if (result.status === 'added') {
                    btn.classList.add('active');
                    btn.innerHTML = '<img src="../assets/images/favorite-on.svg" alt="">';
                }

                if (result.status === 'removed') {
                    btn.classList.remove('active');
                    btn.innerHTML = '<img src="../assets/images/favorite-off.svg" alt="">';
                }
            })
            .catch(error => console.log('Erreur:', error));
    });
});

document.querySelectorAll('.btn-save').forEach(btn => {
    //AJAX : btn envoye au controleur la recette mis en favoris
    btn.addEventListener('click', function () {
        //Récupère l'id dans data-recette
        const recetteId = btn.dataset.recette;
       
        const isActive = btn.classList.contains('active');
        const action = isActive ? 'remove' : 'add';

        const data = `id_recette=${recetteId}&action=${action}`;

        //Fetch qui envoie une requête POST au controleur avec l'id de la recette et l'action
        fetch('../controleurs/favoris.php',
            {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' },
                body: data
            })
            .then(response => response.json())
            .then(result => {
                if (result.status === 'added') {
                    btn.classList.add('active');
                    btn.innerHTML = btn.innerHTML.replace('Enregistrer', 'Enregistré');
                }

                if (result.status === 'removed') {
                    btn.classList.remove('active');
                    btn.innerHTML =btn.innerHTML.replace('Enregistré', 'Enregistrer');
                }
            })
            .catch(error => console.log('Erreur:', error));
    });
});

//Suprimer un favoris dans la page profil
document.querySelectorAll('.btn-supp').forEach(btn => {
    btn.addEventListener('click', function () {
        const recetteId = btn.dataset.recette;

        fetch('../controleurs/favoris.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `id_recette=${recetteId}&action=remove`
        })
        .then(response => response.json())
        .then(data => {
            if(data.status === 'removed') {
                // Retire le favori de l'interface
                btn.closest('.favoris-card').remove();
                console.log(`Recette ${recetteId} supprimée`);
            } else {
                console.error('Erreur lors de la suppression');
            }
        })
        .catch(err => console.error('Erreur AJAX:', err));
    });
});
