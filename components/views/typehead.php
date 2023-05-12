<?php
    use kartik\typeahead\TypeaheadBasic;
?>

<?php
 echo $form->field($model, $field)->widget(TypeaheadBasic::classname(), [
                'data' => $local,
                'dataset' => ['limit' => 10],
                'options' => ['placeholder' => $placeholder, 'autocomplete' => 'off'],
                'pluginOptions' => ['highlight' => true, 'minLength' => 0]
            ]);
?>