
<?= $this->Form->create($choixProg, ['url' => ['action' => 'index']]) ?>
<?= $this->Form->select('programmeChoisi', $listeProg) ?>
<?= $this->Form->button(__('Choisir')) ?>
<?= $this->Form->end(); ?>


<table class="programme">
<?php
foreach($programmes as $programme): ?>
<?= $this->Html->link(
 'Nouveau',
 ['action' => 'add']
); ?>
  <tr>
    <td><?= $programme->nom ?></td>
  </tr>
  <tr>
    <td></td>
    <td>Séries</td>
    <td>Répétitions</td>
    <td>Charge</td>
    <td>Repos</td>
  </tr>
  <?php
  foreach($programme->detailsprogrammes as $exercice): ?>
    <tr>
      <td><?= $exercice->exercice ?></td>
      <td><?= $exercice->series ?></td>
      <td><?= $exercice->repetitions ?></td>
      <td><?= $exercice->poids ?></td>
      <td><?= $exercice->repos ?></td>
    </tr>
  <?php
  endforeach;

endforeach;
 ?>

</table>
<?= $this->Html->link(
 'Modifier',
 ['action' => 'edit', $programme->id]
); ?>
<?= $this->Html->link(
  'Supprimer',
  ['action' => 'delete', $programme->id],
  ['confirm' => 'Voulez-vous supprimer définitivement ce programme ?']
); ?>
