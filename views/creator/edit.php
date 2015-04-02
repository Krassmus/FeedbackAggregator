<form class="studip_form" method="post" action="<?= PluginEngine::getLink($plugin, array(), "creator/edit/".$poll->getId()) ?>">
    <section>
        <label>
            <?= _("Name der Umfrage") ?>
            <input type="text" name="poll[name]" value="<?= htmlReady($poll['name']) ?>">
        </label>
        <label>
            <?= _("Startzeitpunkt") ?>
            <input type="date" name="poll[start_time]" value="<?= $poll['start_time'] ? date("d.m.Y", $poll['start_time']) : "" ?>">
        </label>
        <label>
            <?= _("Endzeitpunkt") ?>
            <input type="date" name="poll[end_time]" value="<?= $poll['end_time'] ? date("d.m.Y", $poll['end_time']) : "" ?>">
        </label>
        <label>
            <?= _("Umfrage") ?>
            <textarea name="poll[description]"><?= htmlReady($poll['description']) ?></textarea>
        </label>
    </section>
    <div style="text-align: center" data-dialog-button>
        <?= \Studip\Button::create(_("Speichern"))  ?>
    </div>
    <script>
        jQuery(function() {
            jQuery("input[type=date]").datepicker();
        });
    </script>
</form>