<?php

declare(strict_types=1);

namespace crazywhalecc;

use ZM\Context\BotContext;
use ZM\Utils\ZMRequest;

class Hitokoto
{
    #[\BotCommand(name:'hitokoto', match: '一言')]
    public function firstBotCommand(BotContext $ctx): void
    {
        if (($hitokoto = self::getHitokoto()) !== null) {
            $ctx->reply($hitokoto["hitokoto"] . "\n----「" . $hitokoto["from"] . "」");
        } else {
            $ctx->reply("哎呀，炸毛出错啦，请待会儿再试试吧！");
        }
    }

    function getHitokoto(): ?array
    {
        $hit = ZMRequest::get("https://v1.hitokoto.cn/");
        if ($hit === false) return null;
        $json = json_decode($hit, true);
        if ($json === null) return null;
        return $json;
    }
}
