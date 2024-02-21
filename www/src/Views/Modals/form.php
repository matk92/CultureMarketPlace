<form action="<?= $config["config"]["action"] ?? "" ?>" method="<?= $config["config"]["method"] ?? "POST" ?>" id="<?= $config["config"]["id"] ?? "" ?>" class="<?= $config["config"]["class"] ?? "" ?>" <?= isset($config["config"]["enctype"]) ? "enctype='{$config["config"]["enctype"]}'" : "" ?>>
        <?php foreach ($config["inputs"] as $name => $input) : ?>
                <div class="<?= $input["class"] ?? "input-box-security" ?>">
                        <label for="<?= $name ?>"><?= $input["label"] ?? "" ?></label>
                        <?php if ($input["type"] === "textarea") : ?>
                                <textarea 
                                        name="<?= $name ?>" 
                                        id="<?= $input["id"] ?? "" ?>" 
                                        style="height: 150px;" 
                                        placeholder="<?= $input["placeholder"] ?? "" ?>" 
                                        <?= isset($input["required"]) ? "required" : ""  ?> 
                                        minLength="<?= $input["minLength"] ?? "" ?>" 
                                        maxLength="<?= $input["maxLength"] ?? "" ?>"
                                ><?= $input["defaultValue"] ?? "" ?></textarea>
                        <?php elseif ($input["type"] === "select") : ?>
                                <select name="<?= $name ?>" id="<?= $input["id"] ?? "" ?>" <?= isset($input["required"]) ? "required" : ""  ?>>
                                        <?php foreach ($input["options"] as $value => $option) : ?>
                                                <option value="<?= $value ?>" <?= isset($input["defaultValue"]) && $input["defaultValue"] == $value ? "selected" : "" ?>>
                                                        <?= $option ?>
                                                </option>
                                        <?php endforeach; ?>
                                </select>
                        <?php elseif ($input["type"] === "checkbox") : ?>
                                <input name="<?= $name ?>" type="checkbox" id="<?= $input["id"] ?? "" ?>" <?= isset($input["checked"]) && $input["checked"] ? "checked" : "" ?>>
                        <?php else : ?>
                                <input 
                                        name="<?= $name ?>" 
                                        type="<?= $input["type"] ?? "text" ?>" 
                                        id="<?= $input["id"] ?? "" ?>" 
                                        placeholder="<?= $input["placeholder"] ?? "" ?>" 
                                        value="<?= $input["defaultValue"] ?? "" ?>" 
                                        <?= isset($input["required"]) ? "required" : ""  ?> 
                                        minLength="<?= $input["minLength"] ?? "" ?>" 
                                        maxLength="<?= $input["maxLength"] ?? "" ?>" 
                                        min="<?= $input["min"] ?? "" ?>" 
                                        max="<?= $input["max"] ?? "" ?>" 
                                        <?= isset($input["accept"]) ? "accept='{$input["accept"]}'" : "" ?> 
                                        step="<?= $input["step"] ?? "" ?>" 
                                        <?= isset($input["maxSize"]) ? "max='{$input["maxSize"]}'" : "" ?>
                                >
                        <?php endif; ?>
                        <?php if (isset($config["errors"]) && array_key_exists($name, $config["errors"])) : ?>
                                <p class="error"><?= $config["errors"][$name] ?></p>
                        <?php endif; ?>
                </div>
        <?php endforeach; ?>
        <?php if (isset($config["config"]["error"]) && $config["config"]["error"] == true) : ?>
                <div class="alert alert-danger" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="24px" height="24px">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                        <p><?= $config["config"]["errorMessage"] ?></p>
                </div>
        <?php endif; ?>
        <input type="submit" class="button btn-security" value="<?= $config["config"]["submit"] ?? "Envoyer" ?>" id="form_submit">
        <div class="spinner hidden" id="spinner_form_<?= $config["config"]["id"] ?>"></div>
</form>

<script>
        $(document).ready(function() {
                if (document.getElementsByName('cardNumber').length > 0) {
                        var cardNumberInput = document.getElementsByName('cardNumber')[0];
                        cardNumberInput.addEventListener('input', function() {
                                var cardNumber = this.value;
                                // Remove any existing spaces
                                cardNumber = cardNumber.replace(/\s/g, '');
                                // Add a space every 4 digits
                                cardNumber = cardNumber.replace(/(\d{4})(?=\d)/g, '$1 ');
                                // Update the input value
                                this.value = cardNumber;
                        });
                }

                if (document.getElementsByName('expirationDate').length > 0) {
                        var cardNumberInput = document.getElementsByName('expirationDate')[0];
                        cardNumberInput.addEventListener('input', function() {
                                var expirationDate = this.value;
                                // Remove any existing spaces
                                expirationDate = expirationDate.replace(/\s/g, '');
                                // Add a space every 2 digits
                                expirationDate = expirationDate.replace(/(\d{2})(?=\d)/g, '$1/');
                                // Update the input value
                                this.value = expirationDate;
                        });
                }

                if (document.getElementById("<?= $config["config"]["id"] ?>") != undefined) {
                        document.getElementById("<?= $config["config"]["id"] ?>").addEventListener('submit', function() {
                                document.getElementById('form_submit').classList.add('hidden');
                                document.getElementById('spinner_form_<?= $config["config"]["id"] ?>').classList.remove('hidden');
                        });
                }
        });
</script>