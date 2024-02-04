<script>
    function evaluateComments() {
        document.getElementById('spinner').classList.remove('hidden');
        document.getElementById('comment_section').classList.add('hidden');
        return true;
    }
</script>
<h1>Commentaires</h1>
<div class="spinner hidden" id="spinner"></div>
<div id="comment_section">
    <?php foreach ($comments as $comment) : ?>
        <div class="comment_card">
            <div class="card-header">
                <div class="row">
                    <h2><?= $comment->firstname ?> <?= $comment->lastname ?></h2>
                    <p> - <?= (new DateTime($comment->inserted))->format('d/m/Y H\hi') ?></p>
                </div>
                <div class="row">
                    <?php for ($i = 0; $i < 5; $i++) :
                        $rating = ($comment->getRating() - $i < 0 ? 0 : ($comment->getRating() - $i > 1 ? 100 : ($comment->getRating() - $i) * 100));
                        $gradientOffset = $rating . '%';
                    ?>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="grad_<?= $comment->getId() ?>_<?= $i ?>" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="0%" style="stop-color:#E3D027;stop-opacity:1" />
                                    <stop offset="<?= $gradientOffset ?>" style="stop-color:#E3D027;stop-opacity:1" />
                                    <stop offset="<?= $gradientOffset ?>" style="stop-color:#505050;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#505050;stop-opacity:1" />
                                </linearGradient>
                            </defs>
                            <path id="Vector" fill-rule="evenodd" clip-rule="evenodd" d="M10.7856 3.20997C11.2336 2.13297 12.7616 2.13297 13.2096 
                                    3.20997L15.2916 8.21697L20.6956 8.64997C21.8596 8.74297 22.3316 10.195 21.4446 10.955L17.3276 14.482L18.5846 19.755C18.8556
                                    20.891 17.6206 21.788 16.6246 21.18L11.9976 18.354L7.37056 21.18C6.37456 21.788 5.13956 20.89 5.41056 19.755L6.66756 14.482L2.55056
                                    10.955C1.66356 10.195 2.13556 8.74297 3.29956 8.64997L8.70356 8.21697L10.7856 3.20997Z" fill="url(#grad_<?= $comment->getId() ?>_<?= $i ?>)" />
                        </svg>
                    <?php endfor; ?>
                </div>
            </div>
            <p><?= $comment->getComment() ?></p>
            <hr>
            <div class="card-footer">
                <a  href="/admin/comments/evaluate?id=<?= $comment->getId() ?>&isapproved=false" class="button button-danger button-esm" onclick="evaluateComments();">
                    Rejeter
                </a>
                <a href="/admin/comments/evaluate?id=<?= $comment->getId() ?>&isapproved=true" class="button button-primary button-esm" onclick="evaluateComments();">
                    Approuver
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>