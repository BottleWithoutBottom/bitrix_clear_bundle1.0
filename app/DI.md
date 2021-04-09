**Dependency-injection module**

Постоянная ссылка:

https://php-di.org/doc/getting-started.html

**_Требуется версия PHP 7.2^_**

Конфигурация DI:

Для того, чтобы контейнер зависимостей работал, ему нужно задать конфигурацию.
Это делается при помощи функции `->addDefinitions(array $config)`, вызванной на экземпляре класса `\DI\ContainerBuilder`;

`array $config` можно передавать как напрямую, так и указав путь до файла, который возвращает этот массив `$config`. Я предлагаю выносить конфиг в отдельный файл `/local/DI/config.php`

    $containerBuilder = new \DI\ContainerBuilder();
    $containerBuilder->addDefinitions(`$_SERVER['DOCUMENT_ROOT'] . '/local/DI/config.php'`);

**Использование контейнера в роуте в `/local/letsrock.lib/lib/router/bootstrap.php/`:**

Т.к. в большинстве проектов используется nikic/Fast-route, то вызов контроллера в нем можно реализовать при помощи контейнера DI. Примерная структура:

    switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $vars['POST'] = $_POST;
        if (empty($vars['POST'])) {
        $postData = file_get_contents('php://input');
        $data = json_decode($postData, true);
        $vars['POST'] = $data;
        }

        $containerBuilder = new \DI\ContainerBuilder();
        $containerBuilder->addDefinitions(DI_CONFIG_PATH);
        $container = $containerBuilder->build();

        list($class, $method) = explode("/", $handler, 2);
        $container->call([$class, $method], $vars);
        break;
}

**Добавление объектов в сервис-контейнер и авто-вайринг**

Простой пример добавления объекта в сервис-контейнер для использования в методах:

    return [
        'BasketService' => function() {
            return new BasketService();
        }
    ];

В данном случае `BasketService` - это класс, объекты которого можно будет использовать.

Пример использования с передачей объекта в качестве DI:

    class BasketController extends Controller
    {
        public function getItems(BasketService $basketService)
        {
            $basketItems = $basketService->getFUserBasketItemsList(
                [
                    'LID' => SITE_ID,
                    'ORDER_ID' => 'NULL',
                    'DELAY' => 'N',
                ],
                ['ID', 'PRODUCT_ID', 'DELAY']
            );
        }
    }

Преимущество такого подхода в том, что нет необходимости инициализировать объект `$basketService`;

**Функция getContainer()**

В файле /local/init.php объявлена функция `getContainer()`, которая позволяет вызывать оъекты из контейнера в любом месте кода