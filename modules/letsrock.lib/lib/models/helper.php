<?php

namespace Letsrock\Lib\Models;
use \CFile;

class Helper extends Model
{
    public static function getResizeImageArray($src, $resizeName) {
        if (!$src || !$resizeName) return false;

        $sizesArray = require(CONSTANTS_PATH . 'resizeImages.php');
        $usedSize = $sizesArray[$resizeName];
        if ($sizesArray[$resizeName]) {
            return CFile::ResizeImageGet(
                $src,
                ['WIDTH' => $usedSize['WIDTH'], 'HEIGHT' => $usedSize['HEIGHT']],
                $usedSize['BX_RESIZE']
            )['src'];
        } else {
            return $src;
        }
    }

    public static function getResizerOptions($resizeName)
    {
        if (empty($resizeName)) return false;

        $sizesArray = require(CONSTANTS_PATH . 'resizeImages.php');
        return $sizesArray[$resizeName];
    }

    public static function getResizeImageArrayById($id, $resizeName)
    {
        if (empty($id) || empty($resizeName)) return false;
        $src = CFile::GetFileArray($id);
        return static::getResizeImageArray($src, $resizeName);
    }
}