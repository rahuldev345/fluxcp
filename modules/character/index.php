<?php
if (!defined('FLUX_ROOT')) exit;

$this->loginRequired();

$bind        = array();
$sqlpartial  = "LEFT OUTER JOIN {$server->charMapDatabase}.guild_member ON guild_member.char_id = ch.char_id ";
$sqlpartial .= "LEFT OUTER JOIN {$server->charMapDatabase}.guild ON guild.guild_id = guild_member.guild_id ";
$sqlpartial .= "LEFT OUTER JOIN {$server->loginDatabase}.login ON login.account_id = ch.account_id ";
$sqlpartial .= "LEFT OUTER JOIN {$server->charMapDatabase}.`char` AS partner ON partner.char_id = ch.partner_id ";
$sqlpartial .= "LEFT OUTER JOIN {$server->charMapDatabase}.`char` AS mother ON mother.char_id = ch.mother ";
$sqlpartial .= "LEFT OUTER JOIN {$server->charMapDatabase}.`char` AS father ON father.char_id = ch.father ";
$sqlpartial .= "LEFT OUTER JOIN {$server->charMapDatabase}.`char` AS child ON child.char_id = ch.child ";
$sqlpartial .= "WHERE 1=1 ";

$charID = $params->get('char_id');
if ($charID) {
	$sqlpartial .= "AND ch.char_id = ? ";
	$bind[]      = $charID;
}
else {
	$opMapping   = array('eq' => '=', 'gt' => '>', 'lt' => '<');
	$opValues    = array_keys($opMapping);
	$account     = $params->get('account');
	$charName    = $params->get('char_name');
	$charClass   = $params->get('char_class');
	$baseLevelOp = $params->get('base_level_op');
	$baseLevel   = $params->get('base_level');
	$jobLevelOp  = $params->get('job_level_op');
	$jobLevel    = $params->get('job_level');
	$zenyOp      = $params->get('zeny_op');
	$zeny        = $params->get('zeny');
	$guild       = $params->get('guild');
	$partner     = $params->get('partner');
	$mother      = $params->get('mother');
	$father      = $params->get('father');
	$child       = $params->get('child');
	$online      = $params->get('online');
	$slotOp      = $params->get('slot_op');
	$slot        = $params->get('slot');
	
	if ($account) {
		if (preg_match('/^\d+$/', $account)) {
			$sqlpartial .= "AND login.account_id = ? ";
			$bind[]      = $account;
		}
		else {
			$sqlpartial .= "AND (login.userid LIKE ? OR login.userid = ?) ";
			$bind[]      = "%$account%";
			$bind[]      = $account;
		}
	}
	
	if ($charName) {
		$sqlpartial .= "AND (ch.name LIKE ? OR ch.name = ?) ";
		$bind[]      = "%$charName%";
		$bind[]      = $charName;
	}
	
	if ($charClass) {
		$className = preg_quote($charClass);
		$classIDs  = preg_grep("/.*?$className.*?/i", Flux::config('JobClasses')->toArray());
		
		if (count($classIDs)) {
			$classIDs    = array_keys($classIDs);
			$sqlpartial .= "AND (";
			$partial     = '';
			
			foreach ($classIDs as $id) {
				$partial .= "ch.class = ? OR ";
				$bind[]   = $id;
			}
			
			$partial     = preg_replace('/\s*OR\s*$/', '', $partial);
			$sqlpartial .= "$partial) ";
		}
		else {
			$sqlpartial .= 'AND ch.class IS NULL ';
		}
	}
	
	if (in_array($baseLevelOp, $opValues) && trim($baseLevel) != '') {
		$op          = $opMapping[$baseLevelOp];
		$sqlpartial .= "AND ch.base_level $op ? ";
		$bind[]      = $baseLevel;
	}
	
	if (in_array($jobLevelOp, $opValues) && trim($jobLevel) != '') {
		$op          = $opMapping[$jobLevelOp];
		$sqlpartial .= "AND ch.job_level $op ? ";
		$bind[]      = $jobLevel;
	}
	
	if (in_array($zenyOp, $opValues) && trim($zeny) != '') {
		$op          = $opMapping[$zenyOp];
		$sqlpartial .= "AND ch.zeny $op ? ";
		$bind[]      = $zeny;
	}
	
	if ($guild) {
		$sqlpartial .= "AND (guild.name LIKE ? OR guild.name = ?) ";
		$bind[]      = "%$guild%";
		$bind[]      = $guild;
	}
	
	if ($partner) {
		$sqlpartial .= "AND (partner.name LIKE ? OR partner.name = ?) ";
		$bind[]      = "%$partner%";
		$bind[]      = $partner;
	}
	
	if ($mother) {
		$sqlpartial .= "AND (mother.name LIKE ? OR mother.name = ?) ";
		$bind[]      = "%$mother%";
		$bind[]      = $mother;
	}
	
	if ($father) {
		$sqlpartial .= "AND (father.name LIKE ? OR father.name = ?) ";
		$bind[]      = "%$father%";
		$bind[]      = $father;
	}
	
	if ($child) {
		$sqlpartial .= "AND (child.name LIKE ? OR child.name = ?) ";
		$bind[]      = "%$child%";
		$bind[]      = $child;
	}
	
	if ($online == 'on' || $online == 'off') {
		if ($online == 'on') {
			$sqlpartial .= "AND ch.online > 0 ";
		}
		else {
			$sqlpartial .= "AND ch.online < 1 ";
		}
	}
	
	if (in_array($slotOp, $opValues) && trim($slot) != '') {
		$op          = $opMapping[$slotOp];
		$sqlpartial .= "AND ch.char_num $op ? ";
		$bind[]      = $slot - 1;
	}
}

$sql  = "SELECT COUNT(ch.char_id) AS total FROM {$server->charMapDatabase}.`char` AS ch $sqlpartial";
$sth  = $server->connection->getStatement($sql);

$sth->execute($bind);
$paginator = $this->getPaginator($sth->fetch()->total);
$paginator->setSortableColumns(array(
	'ch.char_id' => 'asc', 'userid', 'char_name', 'ch.base_level', 'ch.job_level',
	'ch.zeny', 'guild_name', 'partner_name', 'mother_name', 'father_name', 'child_name',
	'ch.online', 'ch.char_num'
));

$col  = "ch.account_id, ch.char_id, ch.name AS char_name, ch.char_num, ";
$col .= "ch.online, ch.base_level, ch.job_level, ch.class, ch.zeny, ";
$col .= "guild.guild_id, guild.name AS guild_name, ";
$col .= "login.userid, partner.name AS partner_name, partner.char_id AS partner_id, ";
$col .= "mother.name AS mother_name, mother.char_id AS mother_id, ";
$col .= "father.name AS father_name, father.char_id AS father_id, ";
$col .= "child.name AS child_name, child.char_id AS child_id ";
$sql  = "SELECT $col FROM {$server->charMapDatabase}.`char` AS ch $sqlpartial";
$sql  = $paginator->getSQL($sql);
$sth  = $server->connection->getStatement($sql);

$sth->execute($bind);

$characters = $sth->fetchAll();

if ($characters && count($characters) === 1) {
	$this->redirect($this->url('character', 'view', array('id' => $characters[0]->char_id)));
}
?>