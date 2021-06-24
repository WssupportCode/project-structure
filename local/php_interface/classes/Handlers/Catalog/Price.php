<?php

namespace WS\Handlers\Catalog;

use Bitrix\Main\Loader;
use WS\Handlers\BaseHandler;

class Price extends BaseHandler
{
    private static $propCode = "filterPrice";

    /**
     * @param $id int Price Id
     * @param $arFields array
     */
    public static function priceUpdateHandler(int $id, array $arFields)
    {
        if ($arFields["PRODUCT_ID"]) {
            self::recalculatePriceProperty($arFields["PRODUCT_ID"]);
        }
    }

    /**
     * @param $discountId int
     */
    public static function discountUpdateHandler($discountId)
    {
        self::updatePrice();
    }

    /**
     * @param int $prodId
     */
    public static function updatePrice(int $prodId = 0)
    {
        self::initModules();
        if ($prodId !== 0) {
            self::recalculatePriceProperty($prodId);
            return;
        }
        $arFilter = [
            "IBLOCK_ID" => CATALOG_IBLOCK_ID,
            "ACTIVE" => "Y"
        ];
        $arSelect = ["ID"];
        $dbRes = \CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
        while ($arRes = $dbRes->Fetch()) {
            if ($arRes["ID"]) {
                self::recalculatePriceProperty($arRes["ID"]);
            }
        }
    }

    /**
     * @throws \Bitrix\Main\LoaderException
     */
    private static function initModules()
    {
        Loader::includeModule('catalog');
        Loader::includeModule('iblock');
    }

    private static function recalculatePriceProperty($prodId)
    {
        $price = \CCatalogProduct::GetOptimalPrice($prodId, 1, [], "N", [], "s1");
        \CIBlockElement::SetPropertyValuesEx($prodId, CATALOG_IBLOCK_ID, [self::$propCode => $price["DISCOUNT_PRICE"]]);
    }
}