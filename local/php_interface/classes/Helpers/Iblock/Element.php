<?

namespace WS\Helpers\Iblock;

use Bitrix\Main\Loader;

class Element
{
    public static function getList($arSort, $arFilter, $arSelect = [])
    {
        self::initModules();
        $result = [];
        if (empty($arFilter)) {
            return $result;
        }
        $dbRes = \CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
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

    /**
     * @param array $arRes
     * @return array
     */
    private static function prepareArRes(array $arRes)
    {
        if ($arRes["PREVIEW_PICTURE"]) {
            $arRes["PREVIEW_PICTURE"] = \CFile::GetPath($arRes["PREVIEW_PICTURE"]);
        }
        if ($arRes["DETAIL_PICTURE"]) {
            $arRes["DETAIL_PICTURE"] = \CFile::GetPath($arRes["DETAIL_PICTURE"]);
        }
        return $arRes;
    }
}