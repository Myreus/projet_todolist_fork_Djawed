<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/pico.min.css">
    <title><?= $title ?></title>
</head>

<body>
    <?php include 'component/navbar.php'; ?>
    <main class="container-fluid">
        <h2>Ajouter une tache</h2>
        <form action="" method="post">
            <input type="text" name="title" placeholder="Saisir le titre" required>
            <textarea name="description" cols="25" rows="10" placeholder="Saisir la description" required></textarea>
            <label for="finish_on">Saisir la date d'échéance</label>
            <input type="datetime-local" name="finish_on">
            <select name="repeat">
                <option selected disabled value="">
                    Sélectionner une répétition pour la tache
                </option>
                <option value="hebdo">Hebdomadaire</option>
                <option value="quotidien">Quotidien</option>
                <option value="mensuel">Mensuel</option>
            </select>
            <select name="categories[]" multiple size="4">
                <option selected disabled value="">
                    Sélectionner les catégories
                </option>
            <?php foreach ($data["categories"] as $category): ?>
                <option value="<?= $category->getId() ?>">
                    <?= $category->getName() ?>
                </option>
            <?php endforeach ?>
            </select>
            <input type="submit" name="submit" value="Ajouter">
        </form>
        <?php if(!empty($data["msg"])): ?>
        <p><?= $data["msg"] ?></p>
        <?php endif ?>
    </main>
</body>

</html>