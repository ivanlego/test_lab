php yii serve --port=8888

http://localhost:8888/item/index?categoryId=3&limit=10

http://localhost:8888/item/index2?categoryId=3&limit=10

**Срок выполнения задания - 24 ч. 00 м. часа с момента его отправки.**

**Контекст ситуации**

Необходимо осуществить выборку 10 товаров из базы данных, которые относятся к 3-ей категории и осуществить конвертацию стоимости в рубли

**Задание**

**Создать 2 миграции со следующим составом:**
1. Создать таблицу items с полями: id, name, category, price, currency
2. Создать таблицу currency c полями: id, date, currency, value

**Создать 2 миграции для наполнения таблиц:**
1. items, генератор 400 000 элементов, где:

name - это рандомный текст из 10-30 символов
category - это рандомное число от 1 до 10
price - это рандомное число от 1 до 10 000
currency - это рандомное значение (EUR или USD)
2. currency, генератор значений для каждой даты в диапазоне от 01.01.2022 по 01.07.2023 для каждой валюты (EUR, USD), где:

date - дата, на которую генерирует значение
currency - валюта, на которую генерирует значение
value - рандомное число в диапазоне от 10 до 100

**Запустить выполнение миграций**

**Создать модели для сущностей items и currency**

**Написать контроллер**

**Цель - выбрать 10 значений из категории 3 и пересчитать стоимость в рублях**


Необходимо реализовать выборку 2-мя способами и замерить скорость выполнения

В первом случае необходимо реализовать выборку из базы данных с вычислением значения в рублях на уровне БД в запросе.
Во втором случае необходимо получить искомые товары (10шт), отдельным запросом получить последние актуальные курсы валют и дописать в первый полученный массив значение стоимости в рублях. 
Стоит обратить внимание, что при расчете priceRUB нужно использовать последнюю актуальную информацию о курсе валюты, на основании currency.date
priceRUB рассчитывается, как items.price * currency.value

**Выходное значение должно быть в виде json со следующей структурой**

{

time: xxxx,

result : [

{name: … , category: …, price: …,  currency: …,  priceRUB: …, dateСurrency: …},

{...}, ...

]

}

time - время выполнения скрипта
result - полученные данные (10 элементов)
priceRUB - это переведенное в рубли значение стоимости
dateСurrency - это на какую дату взят курс валюты

**Цель задания**

Оценить навыки кандидата в следующих областях:

Базовые навыки работы с Framework;
Возможность использования различных вариантов работы с данными;
Оценка эффективности работы кода;

**Пояснение к заданию:**

Реализовать стандартным функционалом ActiveRecord без использования чистого SQL
Необходимо реализовать проект и заархивировать его
Используемый фреймворк для реализации уточните при получении задания

