<?php

namespace app\services;

use app\models\Currency;
use app\models\Item;

class ItemsService
{
    public static function getByCategoryIdWithCurrency(int $categoryId = 0, int $limit = 10): array
    {
        $currency = Currency::find()->select([
            'max(date)'
        ])->where(['currency' => 'c.currency']);
        return Item::find()->select(
            [
                'items.name',
                'items.category',
                'items.price',
                'items.currency',
                'c.date as dateCurrency',
                '(c.value * items.price) AS priceRUB'
            ]
        )->leftJoin(
            'currency c',
            'c.currency = items.currency AND c.date = (select MAX(date) FROM currency curr where curr.currency = c.currency)',
        )->where(
            [
                'items.category' => $categoryId,
            ]
        )
            ->limit($limit)
            ->asArray()
            ->all();
    }

    public static function getByCategoryId(int $categoryId = 0, int $limit = 10): array
    {
        $currencies = Currency::find()
            ->indexBy('currency')
            ->orderBy('date', SORT_DESC)
            ->asArray()
            ->all();
        $items = Item::find()->select(
            [
                'items.name',
                'items.category',
                'items.price',
                'items.currency',
            ]
        )->where(
            [
                'items.category' => $categoryId,
            ]
        )
            ->limit($limit)
            ->asArray()
            ->all();

        foreach ($items as &$item) {
            $item['dateСurrency'] = $currencies[$item['currency']]['date'];
            $item['priceRub'] = $currencies[$item['currency']]['value'] * $item['price'];
        }

        return $items;
    }
}
