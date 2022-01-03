<section id="hero">
    <div class="hero-container" data-aos="fade-up">
        <h1>Utilisateurs</h1>
    </div>
</section>

<h1>Administrer les articles</h1>
<section>
    <table class="table">
        <thead>
            <tr>
                <td>ID</td>
                <td>Email</td>
                <td>Pseudo</td>
                <td>Date de naissance</td>
                <td>Mot de Passe</td>
                <td>Statut</td>
            </tr>
        <tbody>
            <?php foreach ($utilisateurs as $utilisateur) : ?>
                <tr>
                    <td><?= $utilisateur->id_utilisateur; ?></td>
                    <td><?= $utilisateur->email; ?></td>
                    <td><?= $utilisateur->pseudo; ?></td>
                    <td><?= $utilisateur->date_naissance; ?></td>
                    <td><?= $utilisateur->mdp; ?></td>
                    <td><?= $utilisateur->statut; ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
        </thead>
    </table>
</section>