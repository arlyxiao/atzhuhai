<p>Links  (A - Z)</p>
<?php 
	foreach ($data as $k => $v) { 
?>

<span style="float: left; width: 130px; margin-bottom: 5px;">
<a href="<?php echo $v->url; ?>" target="_blank">
<?php echo $v->title; ?> <br />
</a>
</span>

<?php } ?>