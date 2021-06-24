<?php
namespace WS\Agents;

use WS\Parser\Parser;
use WS\Tools\BaseAgent;

class ImportGoods extends BaseAgent {
    /**
     * Run agent function
     *
     * @return void Params next call
     * @throws \Exception
     */
    public function algorithm() {
        $parser = new Parser();
        $parser->run();

        throw new \Exception();
    }
}