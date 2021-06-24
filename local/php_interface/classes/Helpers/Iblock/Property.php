<?php

namespace WS\Helpers\Iblock;

use Bitrix\Main\Loader;

class Property
{
    /**
     * @param string $name enum value
     * @param string|int $propId prop id or prop code
     * @param string|int $iblockId
     * @return array|false
     */
    public static function getEnumByName(string $name, $propId, $iblockId)
    {
        if (!$name || !$propId || !$iblockId) {
            return false;
        }
        self::initModules();
        $arFilter = [
            "VALUE" => $name,
            "PROPERTY_ID" => $propId,
            "IBLOCK_ID" => $iblockId
        ];
        $arRes = \CIBlockPropertyEnum::GetList([], $arFilter)->GetNext();
        if ($arRes) {
            return $arRes;
        }
        return false;
    }

    /**
     * @throws \Bitrix\Main\LoaderException
     */
    private static function initModules()
    {
        Loader::includeModule('iblock');
    }

    /**
     * @param string $propCode
     * @param $iblockId
     * @return false|mixed
     */
    public static function getIdByCode(string $propCode, $iblockId)
    {
        if (!$propCode || !$iblockId) {
            return false;
        }
        self::initModules();
        $arFilter = [
            "CODE" => $propCode,
            "IBLOCK_ID" => $iblockId
        ];
        $arRes = \CIBlockProperty::GetList([], $arFilter)->GetNext();
        if ($arRes) {
            return $arRes["ID"];
        }
        return false;
    }
}