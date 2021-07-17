Структура проекта
===============

Типовая структура файлов и папок для упрощения работы с проектом

## Введение

При работе нескольких разработчиков на проекте возникают трудности в организации структуры библиотеки классов,
обработчиков и других вспомогательных скриптов. Нет единообразия. Каждый разработчик создает скрипты так как ему удобно
и где удобно. Код получается разрозненным, неструктурированным. Поддержка проекта усложняется.

## Цель

Внедрение единообразной структуры проекта для поддержания целостности, структурированности. Обеспечение удобства
поддержки проекта.

## Особенности

Данная структура работает только при наличии установленного на проекте модуля "Инструменты разработчика"

![Модуль wstools.](docs/wstools.png)

Убедитесь в наличии модуля на проекте. Если его нет, то установить можно по ссылке
https://github.com/worksolutions/bitrix-module-tools

## Внедрение
На старте разработки проекта или при приеме готового проекта на поддержку необходимо придерживаться следующей схемы
размещения скриптов:
1. В папке /local (если такой нет, то создать) создать папку /php_interface/

2. В /php_interface добавить следующие папки и файлы:
   
- Папка /classes/ - для хранения библиотеки классов. Классы рекомендуем группировать по предназначению. Например,
агенты размещать в папке Agents, обработчики в папке Handlers, хелперы в папке Helpers, сервисы в папке Services

![Библиотека классов.](docs/classes.jpg)

- Папка /include/ - для хранения подключаемых скриптов, например константы или регистрация обработчиков

![Включаемые скрипты.](docs/include.jpg)

- Файл .ws_tools_config.php - настройка namespace для автоматического подключения классов из папки /classes/

![Настройка namespace.](docs/wstoolsconfig.jpg)

- Файл config.php - файл конфигурации сервисов

![Конфигуратор сервисов.](docs/config.jpg)

- Файл init.php, в котором происходит подключение вышеперечисленных файлов

![Файл init.php.](docs/init.png)

3. Для хранения статических файлов (js, css, шрифтов, иконок, статических картинок) следует использовать папку /static
   (если такой нет, то создать). При этом, файлы созданные на этапе верстки проекта изменениям не подлежат. В противном
   случае произойдет рассинхронизация состояния файлов с версточным репозиторием. Пример размещения:

![Папка для скриптов](docs/static.jpg)

В ходе работы над проектом если возникает необходимость изменить/добавить стили, js, следует создать и подключить новые
файлы css, js (например, bitrix.css, bitrix.js). В этих файлах размещать свои стили и скрипты. В итоге в /static будут
находится базовые нередактируемые файлы из версточного репозитория и дополнительные редактируемые.