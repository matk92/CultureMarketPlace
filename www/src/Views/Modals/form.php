<form action="<?= $config["config"]["action"] ?? "" ?>" method="<?= $config["config"]["method"] ?? "POST" ?>" id="<?= $config["config"]["id"] ?? "" ?>" class="<?= $config["config"]["class"] ?? "" ?>">
        <?php foreach ($config["inputs"] as $name => $input) : ?>
                <div class="<?= $input["class"] ?? "input-box-security" ?>">
                        <label for="<?= $name ?>"><?= $input["label"] ?? "" ?></label>
                        <input name="<?= $name ?>" type="<?= $input["type"] ?? "text" ?>" id="<?= $input["id"] ?? "" ?>" placeholder="<?= $input["placeholder"] ?? "" ?>" <?= $input["required"] ? "required" : ""  ?>>
                </div>
        <?php endforeach; ?>
        <?php if (isset($config["config"]["errorMessage"])) : ?>
                <div class="alert alert-danger" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="24px" height="24px">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                        <p><?= $config["config"]["errorMessage"] ?></p>
                </div>
        <?php endif; ?>
        <input type="submit" class="btn-security" value="<?= $config["config"]["submit"] ?? "Envoyer" ?>">
</form>