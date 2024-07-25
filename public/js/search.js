// public/js/search.js
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('save-search-button').addEventListener('click', function () {
        const form = document.getElementById('search-form');
        const formData = new FormData(form);

        // Convertir les données du formulaire en objet
        const searchParams = {};
        formData.forEach((value, key) => {
            searchParams[key] = value;
        });

        // Demander un nom pour la recherche
        const name = prompt('Entrez un nom pour cette recherche :');
        if (!name) {
            alert('Vous devez entrer un nom pour sauvegarder la recherche.');
            return;
        }

        // Envoi de la requête POST pour sauvegarder la recherche
        fetch('/saved-searches', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                name: name,
                search_criteria: searchParams
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Recherche sauvegardée avec succès.');
            } else {
                alert('Erreur lors de la sauvegarde de la recherche.');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur lors de la sauvegarde de la recherche.');
        });
    });
});

function resetForm() {
    document.getElementById('search-form').reset();
}
