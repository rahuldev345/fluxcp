<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2>Items</h2>
<form class="search-form" method="get">
	<?php echo $this->moduleActionFormInputs($params->get('module')) ?>
	<p>Search for item(s):</p>
	<p>
		<label for="item_id">Item ID:</label>
		<input type="text" name="item_id" id="item_id" value="<?php echo htmlspecialchars($params->get('item_id')) ?>" />
		…
		<label for="name">Name:</label>
		<input type="text" name="name" id="name" value="<?php echo htmlspecialchars($params->get('name')) ?>" />
		…
		<label for="npc_buy">NPC Buy:</label>
		<select name="npc_buy_op">
			<option value="eq"<?php if (($npc_buy_op=$params->get('npc_buy_op')) == 'eq') echo ' selected="selected"' ?>>is equal to</option>
			<option value="gt"<?php if ($npc_buy_op == 'gt') echo ' selected="selected"' ?>>is greater than</option>
			<option value="lt"<?php if ($npc_buy_op == 'lt') echo ' selected="selected"' ?>>is less than</option>
		</select>
		<input type="text" name="npc_buy" id="npc_buy" value="<?php echo htmlspecialchars($params->get('npc_buy')) ?>" />
		…
		<label for="npc_sell">NPC Sell:</label>
		<select name="npc_sell_op">
			<option value="eq"<?php if (($npc_sell_op=$params->get('npc_sell_op')) == 'eq') echo ' selected="selected"' ?>>is equal to</option>
			<option value="gt"<?php if ($npc_sell_op == 'gt') echo ' selected="selected"' ?>>is greater than</option>
			<option value="lt"<?php if ($npc_sell_op == 'lt') echo ' selected="selected"' ?>>is less than</option>
		</select>
		<input type="text" name="npc_sell" id="npc_sell" value="<?php echo htmlspecialchars($params->get('npc_sell')) ?>" />
	</p>
	<p>
		<label for="weight">Weight:</label>
		<select name="weight_op">
			<option value="eq"<?php if (($weight_op=$params->get('weight_op')) == 'eq') echo ' selected="selected"' ?>>is equal to</option>
			<option value="gt"<?php if ($weight_op == 'gt') echo ' selected="selected"' ?>>is greater than</option>
			<option value="lt"<?php if ($weight_op == 'lt') echo ' selected="selected"' ?>>is less than</option>
		</select>
		<input type="text" name="weight" id="weight" value="<?php echo htmlspecialchars($params->get('weight')) ?>" />
		…
		<label for="attack">Attack:</label>
		<select name="attack_op">
			<option value="eq"<?php if (($attack_op=$params->get('attack_op')) == 'eq') echo ' selected="selected"' ?>>is equal to</option>
			<option value="gt"<?php if ($attack_op == 'gt') echo ' selected="selected"' ?>>is greater than</option>
			<option value="lt"<?php if ($attack_op == 'lt') echo ' selected="selected"' ?>>is less than</option>
		</select>
		<input type="text" name="attack" id="attack" value="<?php echo htmlspecialchars($params->get('attack')) ?>" />
		…
		<label for="defense">Defense:</label>
		<select name="defense_op">
			<option value="eq"<?php if (($defense_op=$params->get('defense_op')) == 'eq') echo ' selected="selected"' ?>>is equal to</option>
			<option value="gt"<?php if ($defense_op == 'gt') echo ' selected="selected"' ?>>is greater than</option>
			<option value="lt"<?php if ($defense_op == 'lt') echo ' selected="selected"' ?>>is less than</option>
		</select>
		<input type="text" name="defense" id="defense" value="<?php echo htmlspecialchars($params->get('defense')) ?>" />
	</p>
	<p>
		<label for="refineable">Refineable:</label>
		<select name="refineable" id="refineable">
			<option value=""<?php if (!($account_state=$params->get('refineable'))) echo ' selected="selected"' ?>>All</option>
			<option value="yes"<?php if ($account_state == 'yes') echo ' selected="selected"' ?>>Yes</option>
			<option value="no"<?php if ($account_state == 'no') echo ' selected="selected"' ?>>No</option>
		</select>
		…
		<label for="range">Range:</label>
		<select name="range_op">
			<option value="eq"<?php if (($range_op=$params->get('range_op')) == 'eq') echo ' selected="selected"' ?>>is equal to</option>
			<option value="gt"<?php if ($range_op == 'gt') echo ' selected="selected"' ?>>is greater than</option>
			<option value="lt"<?php if ($range_op == 'lt') echo ' selected="selected"' ?>>is less than</option>
		</select>
		<input type="text" name="range" id="range" value="<?php echo htmlspecialchars($params->get('range')) ?>" />
		…
		<label for="slots">Slots:</label>
		<select name="slots_op">
			<option value="eq"<?php if (($slots_op=$params->get('slots_op')) == 'eq') echo ' selected="selected"' ?>>is equal to</option>
			<option value="gt"<?php if ($slots_op == 'gt') echo ' selected="selected"' ?>>is greater than</option>
			<option value="lt"<?php if ($slots_op == 'lt') echo ' selected="selected"' ?>>is less than</option>
		</select>
		<input type="text" name="slots" id="slots" value="<?php echo htmlspecialchars($params->get('slots')) ?>" />
		
		<input type="submit" value="Search" />
		<input type="button" value="Reset" onclick="reload()" />
	</p>
</form>
<?php if ($items): ?>
<?php echo $paginator->infoText() ?>
<table class="horizontal-table">
	<tr>
		<th><?php echo $paginator->sortableColumn('id', 'Item ID') ?></th>
		<th><?php echo $paginator->sortableColumn('name', 'Name') ?></th>
		<th><?php echo $paginator->sortableColumn('price_buy', 'NPC Buy') ?></th>
		<th><?php echo $paginator->sortableColumn('price_sell', 'NPC Sell') ?></th>
		<th><?php echo $paginator->sortableColumn('weight', 'Weight') ?></th>
		<th><?php echo $paginator->sortableColumn('attack', 'Attack') ?></th>
		<th><?php echo $paginator->sortableColumn('defense', 'Defense') ?></th>
		<th><?php echo $paginator->sortableColumn('range', 'Range') ?></th>
		<th><?php echo $paginator->sortableColumn('slots', 'Slots') ?></th>
		<th><?php echo $paginator->sortableColumn('refineable', 'Refineable') ?></th>
	</tr>
	<?php foreach ($items as $item): ?>
	<tr>
		<td align="right"><?php echo htmlspecialchars($item->id) ?></td>
		<td><?php echo htmlspecialchars($item->name) ?></td>
		<td><?php echo number_format((int)$item->price_buy) ?></td>
		<td><?php echo number_format((int)$item->price_sell) ?></td>
		<td><?php echo number_format((int)$item->weight) ?></td>
		<td><?php echo number_format((int)$item->attack) ?></td>
		<td><?php echo number_format((int)$item->defense) ?></td>
		<td><?php echo number_format((int)$item->range) ?></td>
		<td><?php echo number_format((int)$item->slots) ?></td>
		<td>
			<?php if ($item->refineable): ?>
				<span class="refineable yes">Yes</span>
			<?php else: ?>
				<span class="refineable no">No</span>
			<?php endif ?>
		</td>
	</tr>
	<?php endforeach ?>
</table>
<?php echo $paginator->getHTML() ?>
<?php else: ?>
<p>No items found. <a href="javascript:history.go(-1)">Go back</a>.</p>
<?php endif ?>