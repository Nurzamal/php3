# php
<?php
require __DIR__ . '/vendor/autoload.php';

use YoutubeDl\YoutubeDl;
use YoutubeDl\Exception\CopyrightException;
use YoutubeDl\Exception\NotFoundException;
use YoutubeDl\Exception\PrivateVideoException;

$dl = new YoutubeDl([
    'continue' => true, // принудительное возобновление частично загруженных файлов. 
    'format' => 'bestvideo',
]);
//для этого питон нужен? 
$dl->setDownloadPath('/home/user/downloads');
// Enable debugging
/*$dl->debug(function ($type, $buffer) {
    if (\Symfony\Component\Process\Process::ERR === $type) {
        echo 'ERR > ' . $buffer;
    } else {
        echo 'OUT > ' . $buffer;
    }
});*/
try {
    $video = $dl->download('https://www.youtube.com/watch?v=nLg-s79-ob0');
    echo $video->getTitle(); //вернет песню 23:45 Feat. 5ivesta Family
    // $video->getFile(); // \SplFileInfo instance of downloaded file
} catch (NotFoundException $e) {
    // Видео не найдено
} catch (PrivateVideoException $e) {
    // Видео закрыто
} catch (CopyrightException $e) {
    // Учетная запись YouTube
} catch (\Exception $e) {
    // ошибка не удалось загрузить 
}
