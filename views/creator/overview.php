<table class="default">
    <thead>
        <tr>
            <th><?= _("Name") ?></th>
            <th><?= _("Startzeitpunkt") ?></th>
            <th><?= _("Endzeitpunkt") ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <? foreach ($polls as $poll) : ?>
            <tr>
                <td><?= htmlReady($poll['name'])  ?></td>
                <td><?= date("d.m.Y", $poll['start_time']) ?></td>
                <td><?= date("d.m.Y", $poll['end_time']) ?></td>
                <td>
                    <? if ($poll['start_time'] > time()) : ?>
                    <a href="<?= PluginEngine::getLink($plugin, array(), "creator/edit/".$poll->getId()) ?>" data-dialog>
                    <?= Assets::img("icons/blue/20/edit", array('class' => "text-bottom")) ?>
                    </a>
                    <? endif ?>
                </td>
            </tr>
        <? endforeach ?>
    </tbody>
</table>

<?

$actions = new ActionsWidget();
$actions->addLink(_("Neue Umfrage erstellen"), PluginEngine::getURL($plugin, array(), "creator/edit"), null, array('data-dialog' => "1"));

Sidebar::Get()->addWidget($actions);