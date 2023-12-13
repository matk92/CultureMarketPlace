<form action="<?= $config["config"]["action"] ?? "" ?>" method="<?= $config["config"]["method"] ?? "POST" ?>" id="<?= $config["config"]["id"] ?? "" ?>" class="<?= $config["config"]["class"] ?? "" ?>">
        <?php foreach ($config["inputs"] as $name => $input) : ?>
                <div class="form-group">
                        <label for="<?= $name ?>"><?= $input["label"] ?? "" ?></label>
                        <input name="<?= $name ?>" type="<?= $input["type"] ?? "text" ?>" class="<?= $input["class"] ?? "" ?>" id="<?= $input["id"] ?? "" ?>" placeholder="<?= $input["placeholder"] ?? "" ?>" <?= $input["required"] ? "required" : ""  ?>>
                </div>
        <?php endforeach; ?>
        <input type="submit" class="btn btn-primary" value="<?= $config["config"]["submit"] ?? "Envoyer" ?>">
</form>