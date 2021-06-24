<?

namespace WS\Helpers\Iblock;

use Bitrix\Main\Loader;
use CIBlock;

class Iblock
{
    public static function getIdByCode($code) {
        self::initModules();

        if (empty($code)) {
            return false;
        }

        $res = CIBlock::GetList(
            [],
            [
                'TYPE' => 'catalog',
                'SITE_ID' => SITE_ID,
                'ACTIVE' => 'Y',
                "=CODE" => $code
            ], false
        );
        if ($arRes = $res->Fetch()) {
            return $arRes['ID'];
        }
        return false;
    }

    /**
     * @throws \Bitrix\Main\LoaderException
     */
    private static function initModules() {
        Loader::includeModule('iblock');
    }
}