<?php
class Delete{
	public static function deleteDir($dirPath) {
    if (! is_dir($dirPath)) {
        throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            self::deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
    return TRUE;
	}
}
$path = "./cht_saver";
//$d = new Delete;
$delete = $d->deleteDir($path);
if(!$delete){
    echo "Gagal Menghapus";
}
