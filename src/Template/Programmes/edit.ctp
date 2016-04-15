<?= $this->Form->create('detailsprogrammes') ?>
<?= $this->Form->hidden('user_id', ['value' => $user]) ?>

<table>


<?php
foreach($programmeAModifier as $donneeProgramme): ?>

  <tr>
    <td>
      <?= $this->Form->input('nom', [
        'value' => $donneeProgramme->nom,
        'label' => 'Nom du programme'
      ]) ?>
    </td>
  </tr>
  <tr>
    <td></td>
    <td>Séries</td>
    <td>Répétitions</td>
    <td>Charge</td>
    <td>Repos</td>
  </tr>

<?php
  foreach($donneeProgramme->detailsprogrammes as $key => $elementProg):
?>
    <tr>
      <td>
        <?= $elementProg->exercice ?>
      </td>
      <td>
        <?= $this->Form->input('detailsprogrammes.'. $key .'.series', [
          'value' => $elementProg->series,
          'label' => '',
          'type' => 'number'
        ]) ?>
      </td>
      <td>
        <?= $this->Form->input('detailsprogrammes.'. $key .'.repetitions', [
          'value' => $elementProg->repetitions,
          'label' => '',
          'type' => 'number'
        ]) ?>
      </td>
      <td>
        <?= $this->Form->input('detailsprogrammes.'. $key .'.poids', [
          'value' => $elementProg->poids,
          'label' => '',
          'type' => 'number'
        ]) ?>
      </td>
      <td>
        <?= $this->Form->input('detailsprogrammes.'. $key .'.repos', [
          'value' => $elementProg->repos,
          'label' => '',
          'type' => 'number'
        ]) ?>
      </td>
    </tr>

<?php
  endforeach;
endforeach;
?>

</table>

<input type="button" value="+" id="ajouter">


<?= $this->Form->button(__('Modifier')) ?>
<?= $this->Form->end() ?>

<script src='http://code.jquery.com/jquery.min.js'></script>
<script type="text/javascript">
$(function() {
  var i = <?= $key ?>;
  var listeExo = <?= json_encode($listeExoJs) ?>;
  $('#ajouter').click(function(){
    i++;
    alert(i);

    //Création des options du select
    var options;
    for(var k = 0; k < listeExo.length; k++) {
       options += "<option value='" + listeExo[k] +"'>"+ listeExo[k] + "</option>";
    }
    $('tbody').append("<tr>");
      $('tbody').append("<td><select name='detailsprogrammes[" + i + "][exercice]'>" + options + "</select></td>");
      $('tbody').append("<td><input name='detailsprogrammes[" + i + "][series]' type='number'></td>");
      $('tbody').append("<td><input name='detailsprogrammes[" + i + "][repetitions]' type='number'></td>");
      $('tbody').append("<td><input name='detailsprogrammes[" + i + "][poids]' type='number'></td>");
      $('tbody').append("<td><input name='detailsprogrammes[" + i + "][repos]' type='number'></td>");

    $('tbody').append("</tr>");

  });

});

</script>
