<?php

namespace WS\Helpers\Iblock;

use Bitrix\Main\Loader;

class Section
{
    public static function getList($arSort, $arFilter, $arSelect = [])
    {
        self::initModules();
        $result = [];
        if (empty($arFilter)) {
            return $result;
        }
        $dbRes = \CIBlockSection::GetList($arSort, $arFilter, false, $arSelect);
        while ($arRes = $dbRes->GetNext()) {
            $arRes = self::prepareArRes($arRes);
            $result[] = $arRes;
        }
        return $result;
    }

    /**
     * @throws \Bitrix\Main\LoaderException
     */
    private static function initModules()
    {
        Loader::includeModule('main');
        Loader::includeModule('iblock');
    }

    private static function prepareArRes(array $arRes)
    {
        if ($arRes["PICTURE"]) {
            $arRes["PICTURE"] = \CFile::GetPath($arRes["PICTURE"]);
        }
        return $arRes;
    }
}