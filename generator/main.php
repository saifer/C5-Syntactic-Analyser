<?php
error_reporting(E_ALL);
include_once('nivre.php');

	$move_values = array(
		"stack" => $stacks,
		"buffer" => $buffers,
		"arcs" => $arcsz
	);
	$move_AttrList = array('stack','buffer','arcs');
	$move_class = array("SHIFT","REDUCE","LEFT ARC","RIGHT ARC");

	//manam variantam
	$toFile = "var examples = [
";

		$n = 1;
		$c = count($move_instances);
		foreach($move_instances as $move){
			$toFile .= "{stack:'".($move['stack']=='' ? 'NULL' : $move['stack'])."', buffer:'".($move['buffer']=='' ? 'NULL' : $move['buffer'])."', stackTopHasArc:'".($move['stackTopHasArc'] ? 'true' : 'false')."', bufferNextHasArc:'".($move['bufferNextHasArc'] ? 'true' : 'false')."', move:'".$move['category']."'}";
			if($n<$c){$n++;$toFile .= ",\n";}
		}
		$toFile .= "
];\n";
		$toFile .= "examples = _(examples);\n";
		$toFile .= "var features = ['stack','buffer','stackTopHasArc','bufferNextHasArc'];\n";
		
		$file = 'data.js';
		file_put_contents($file, $toFile);
	
	//oriģinālajam C5
	$toFile = "";
		$n = 1;
		$c = count($move_instances);
		foreach($move_instances as $move){
			$toFile .= ($move['stack']=='' ? 'NULL' : $move['stack']).", ".($move['buffer']=='' ? 'NULL' : $move['buffer']).", ".($move['stackTopHasArc'] ? 'true' : 'false').", ".($move['bufferNextHasArc'] ? 'true' : 'false').", ".$move['category'];
			if($n<$c){$n++;$toFile .= "\n";}
		}
		
		$file = 'data.data';
		file_put_contents($file, $toFile);
		
		
		$namesFile = "SHIFT, REDUCE, LEFT ARC, RIGHT ARC.\n\n";
		$namesFile .= "Stack: discrete 1000000.\n";
		$namesFile .= "Buffer: discrete 1000000.\n";
		$namesFile .= "stackTopHasArc: true, false.\n";
		$namesFile .= "bufferNextHasArc: true, false.\n";


		$namesFilefile = 'data.names';
		file_put_contents($namesFilefile, $namesFile);
	