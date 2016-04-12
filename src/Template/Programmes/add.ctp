<?= $this->Form->create('detailsprogrammes') ?>


<table>
  <tr>
    <td>
      <?= $this->Form->input('nom', ['label' => 'Nom du programme']) ?>
      <?= $this->Form->hidden('user_id', ['value' => $user]) ?>
    </td>
  </tr>

  <tr>
    <td></td>
    <td>Séries</td>
    <td>Répétitions</td>
    <td>Charge</td>
    <td>Repos</td>
  </tr>

  <tr>
    <td>

      <?= $this->Form->select(
        'detailsprogrammes.0.exercice',
        $listeExo
      ) ?>
    </td>
    <td>
      <?= $this->Form->input('detailsprogrammes.0.series', ['type' => 'number', 'label' => '']) ?>
    </td>
    <td>
      <?= $this->Form->input('detailsprogrammes.0.repetitions', ['type' => 'number', 'label' => '']) ?>
    </td>
    <td>
      <?= $this->Form->input('detailsprogrammes.0.poids', ['type' => 'number', 'label' => '']) ?>
    </td>
    <td>
      <?= $this->Form->input('detailsprogrammes.0.repos', ['type' => 'number', 'label' => '']) ?>
    </td>
  </tr>
</table>
<input type="button" value="+" id="ajouter">

<?= $this->Form->button(__('Sauvegarder')) ?>
<?= $this->Form->end() ?>

<script src='http://code.jquery.com/jquery.min.js'></script>
<script type="text/javascript">
$(function() {
  var i = 0;
  var listeExo = <?= json_encode($listeExoJs) ?>;
  $('#ajouter').click(function(){
    i++;

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
