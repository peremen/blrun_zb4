<form method='post' name='list' action='list_all.php'>
<input type='hidden' name='page' value='<?=$page?>'>
<input type='hidden' name='id' value='<?=$id?>'>
<input type='hidden' name='select_arrange' value='<?=$select_arrange?>'>
<input type='hidden' name='desc' value='<?=$desc?>'>
<input type='hidden' name='page_num' value='<?=$page_num?>'>
<input type='hidden' name='selected'>
<input type='hidden' name='exec'>
<input type='hidden' name='keyword' value="<?=$keyword?>">
<input type='hidden' name='sn' value="<?=$sn?>">
<input type='hidden' name='ss' value="<?=$ss?>">
<input type='hidden' name='sc' value="<?=$sc?>">
<input type='hidden' name='sm' value="<?=$sm?>">
<?$coloring=0;?>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> align=center>
<tr><td>
	<table border=0 cellspacing=0 cellpadding=3 width=100% align=center style=table-layout:fixed>
		
<?$counter=1;?>