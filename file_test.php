<?php
	$filepath = 'tmp/';
	$filename = "aaa.docx";

	echo "<a href=".$filepath.$filename." target='_blank'>file</a>";
	/*
    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header("Content-Type: image/png");
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/' . $filename));
        readfile('uploads/' . $filename);
	}
	else {
		echo "File not exists";
	}
	*/
?>		