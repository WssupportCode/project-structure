<?php

namespace WS\Handlers;

use Bitrix\Main\Event;
use WS\Tools\Events\CustomHandler;


abstract class BaseHandler extends CustomHandler {

    /**
     * Valid class name by static call
     * @return string
     */
    static public function className() {
        return get_called_class();
    }

    /**
     * @return Event|null
     */
    protected function getEvent() {
        $data = $this->getParams();
        foreach ($data as $param) {
            if ($param instanceof Event) {
                return $param;
            }
        }
        return null;
    }
}