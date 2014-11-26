<maniaapp version="1.0" background="1">
    <timeout>0</timeout>
    <script>
    <?= htmlentities(file_get_contents(__DIR__.'/../../maniascript/DogeApp.Script.txt'), ENT_QUOTES, 'UTF-8') ?>
    </script>
</maniaapp>