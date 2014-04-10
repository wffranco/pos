<?php $cs=count($headers)>0?ceil(8/count($headers)):1; ?>
<div style="text-align:center;">
	<div id="receipt_header">
		<div id="page_title" style="margin-bottom:6px;text-align:center;"><?=$title?></div>
		<div id="page_subtitle" style="margin-bottom:6px;"><?=$subtitle?></div>
		<div id="page_subtitle" style="margin-bottom:6px;"><?="($location)"?></div>
	</div>
</div>
<?php if($export_excel){ ?><br/><?php } ?>
<div id="table_holder">
	<table class="tablesorter report" <?php if($export_excel) echo 'border="1"'; ?>>
		<thead>
			<tr style="color:#FFFFFF;background-color:#396B98;">
				<?php foreach ($headers as $header) { ?>
				<th colspan="<?php echo $cs; ?>"><?php echo $header; ?></th>
				<?php } ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($data as $row) { ?>
			<tr>
				<?php foreach ($row as $cell) { ?>
				<td colspan="<?php echo $cs; ?>" style="<?php if($export_excel) echo 'text-align:center;'; ?>"><?php echo $cell; ?></td>
				<?php } ?>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<?php if($export_excel){ ?><br/><?php } ?>
<div style="text-align:center;">
	<div id="report_summary">
	<?php foreach($summary_data as $name=>$value) { ?>
		<div class="summary_row"><?php echo $this->lang->line('reports_'.$name). ': '.to_currency($value); ?></div>
	<?php }?>
	</div>
	<div id="location_id" style="margin: 0 auto;\">Location:<?=$location?></div>
</div>
<?php
if(!isset($last)) echo '<br/><hr/><br/>';

if(!$export_excel&&isset($last)){
?>
<script type="text/javascript" language="javascript">
	$('.tablesorter').each(function(){
		if($(this).find('tr').length >1) $(this).tablesorter();
	});
</script>
<?php
}
?>
