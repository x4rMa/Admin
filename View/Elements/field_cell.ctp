<td class="col-<?php echo $field; ?> type-<?php echo $data['type']; ?>">
	<?php echo $this->element('field', array(
		'result' => $result,
		'field' => $field,
		'data' => $data,
		'value' => $result[$model->alias][$field]
	)); ?>
</td>