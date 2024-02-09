<form action="<?= $config["config"]["action"] ?? "" ?>" method="<?= $config["config"]["method"] ?? "POST" ?>" id="<?= $config["config"]["id"] ?? "" ?>" class="<?= $config["config"]["class"] ?? "" ?>" <?= isset($config["config"]["enctype"]) ? "enctype='{$config["config"]["enctype"]}'" : "" ?>>
        <?php foreach ($config["inputs"] as $name => $input) : ?>
                <div class="<?= $input["class"] ?? "input-box-security" ?>">
                        <label for="<?= $name ?>"><?= $input["label"] ?? "" ?></label>
                        <?php if ($input["type"] === "textarea") : ?>
                                <textarea name="<?= $name ?>" id="<?= $input["id"] ?? "" ?>" style="height: 150px;" placeholder="<?= $input["placeholder"] ?? "" ?>" <?= isset($input["required"]) ? "required" : ""  ?> minLength="<?= $input["minLength"] ?? "" ?>" maxLength="<?= $input["maxLength"] ?? "" ?>"><?= $input["defaultValue"] ?? "" ?></textarea>
                        <?php elseif ($input["type"] === "select") : ?>
                                <select name="<?= $name ?>" id="<?= $input["id"] ?? "" ?>" <?= isset($input["required"]) ? "required" : ""  ?>>
                                        <?php foreach ($input["options"] as $value => $option) : ?>
                                                <option value="<?= $value ?>" <?= isset($input["defaultValue"]) && $input["defaultValue"] == $value ? "selected" : "" ?>>
                                                        <?= $option ?>
                                                </option>
                                        <?php endforeach; ?>
                                </select>
                        <?php else : ?>
                                <input name="<?= $name ?>" type="<?= $input["type"] ?? "text" ?>" id="<?= $input["id"] ?? "" ?>" placeholder="<?= $input["placeholder"] ?? "" ?>" value="<?= $input["defaultValue"] ?? "" ?>" <?= isset($input["required"]) ? "required" : ""  ?> minLength="<?= $input["minLength"] ?? "" ?>" maxLength="<?= $input["maxLength"] ?? "" ?>" min="<?= $input["min"] ?? "" ?>" max="<?= $input["max"] ?? "" ?>" <?= isset($input["accept"]) ? "accept='{$input["accept"]}'" : "" ?>>
                        <?php endif; ?>
                        <?php if (isset($config["errors"]) && array_key_exists($name, $config["errors"])) : ?>
                                <p class="error"><?= $config["errors"][$name] ?></p>
                        <?php endif; ?>
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