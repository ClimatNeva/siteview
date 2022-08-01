<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Бренды | Кондиционеры, вентиляция и камины с установкой в Санкт-Петербурге. Бесплатный выезд специалистов. Доставка и монтаж. ☎ Звоните: 8 (812) 642-40-20");
$APPLICATION->SetPageProperty("title", "Бренды | Купить кондиционер и вентиляцию в Санкт-Петербурге. Цены, доставка, монтаж | Климат Нева ");
$APPLICATION->SetTitle("Бренды");
?><?$APPLICATION->IncludeComponent("alexkova.market:catalog", "brands_new1", Array(
	"ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
		"ADD_ELEMENT_CHAIN" => "N",	// Включать название элемента в цепочку навигации
		"ADD_PICT_PROP" => "MORE_PHOTO",	// Дополнительная картинка основного товара
		"ADD_PROPERTIES_TO_BASKET" => "Y",	// Добавлять в корзину свойства товаров и предложений
		"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"ALSO_BUY_ELEMENT_COUNT" => "4",	// Количество элементов для отображения
		"ALSO_BUY_MIN_BUYES" => "1",	// Минимальное количество покупок товара
		"BASKET_URL" => "/personal/basket.php",	// URL, ведущий на страницу с корзиной покупателя
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"COMPARE_ELEMENT_SORT_FIELD" => "shows",	// По какому полю сортируем элементы
		"COMPARE_ELEMENT_SORT_ORDER" => "asc",	// Порядок сортировки элементов
		"SHOW_LEFT_MENU" => "Y",	// Выводить левое меню
		"COMPARE_FIELD_CODE" => array(	// Поля
			0 => "NAME",
			1 => "DETAIL_PICTURE",
			2 => "",
		),
		"COMPARE_NAME" => "CATALOG_COMPARE_LIST",	// Уникальное имя для списка сравнения
		"COMPARE_OFFERS_FIELD_CODE" => array(	// Поля предложений
			0 => "",
			1 => "",
		),
		"COMPARE_OFFERS_PROPERTY_CODE" => array(	// Свойства предложений
			0 => "",
			1 => "",
		),
		"COMPARE_PROPERTY_CODE" => array(	// Свойства
			0 => "MANUFACTURER",
			1 => "MINIMUM_PRICE",
			2 => "MAXIMUM_PRICE",
			3 => "",
		),
		"COMPARE_SCROLL_UP" => "Y",
		"COMPONENT_TEMPLATE" => "brands_new",
		"CONVERT_CURRENCY" => "Y",	// Показывать цены в одной валюте
		"DETAIL_ADD_DETAIL_TO_SLIDER" => "Y",	// Добавлять детальную картинку в слайдер
		"DETAIL_BLOG_URL" => "catalog_comments",
		"DETAIL_BLOG_USE" => "Y",
		"DETAIL_BRAND_PROP_CODE" => array(	// Таблица с брендами
			0 => "MANUFACTURER",
			1 => "",
		),
		"DETAIL_BRAND_USE" => "Y",	// Использовать компонент "Бренды"
		"DETAIL_BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
		"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",	// Использовать код группы из переменной, если не задан раздел элемента
		"DETAIL_DETAIL_PICTURE_MODE" => "IMG",	// Режим показа детальной картинки
		"DETAIL_DISPLAY_NAME" => "Y",	// Выводить название элемента
		"DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "H",	// Показ описания для анонса на детальной странице
		"DETAIL_FB_USE" => "N",	// Использовать Facebook
		"DETAIL_META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
		"DETAIL_META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
		"DETAIL_OFFERS_FIELD_CODE" => array(	// Поля предложений
			0 => "NAME",
			1 => "",
		),
		"DETAIL_OFFERS_PROPERTY_CODE" => array(	// Свойства предложений
			0 => "",
			1 => "",
		),
		"DETAIL_PROPERTY_CODE" => array(	// Свойства
			0 => "MANUFACTURER",
			1 => "",
		),
		"DETAIL_SHOW_MAX_QUANTITY" => "N",	// Показывать общее количество товара
		"DETAIL_USE_COMMENTS" => "Y",	// Включить отзывы о товаре
		"DETAIL_USE_VOTE_RATING" => "Y",	// Включить рейтинг товара
		"DETAIL_VK_API_ID" => "API_ID",
		"DETAIL_VK_USE" => "N",	// Использовать Вконтакте
		"DETAIL_VOTE_DISPLAY_AS_RATING" => "rating",	// В качестве рейтинга показывать
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"DISPLAY_ELEMENT_SELECT_BOX" => "N",	// Выводить список элементов инфоблока
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"ELEMENT_SORT_FIELD" => array(	// По какому полю сортируем товары в разделе
			0 => "PROPERTY_MINIMUM_PRICE",
		),
		"ELEMENT_SORT_FIELD2" => "shows",	// Поле для второй сортировки товаров в разделе
		"ELEMENT_SORT_ORDER" => "asc",	// Порядок сортировки товаров в разделе
		"ELEMENT_SORT_ORDER2" => "asc",	// Порядок второй сортировки товаров в разделе
		"FILTER_FIELD_CODE" => array(	// Поля
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",	// Фильтр
		"FILTER_OFFERS_FIELD_CODE" => array(	// Поля предложений
			0 => "",
			1 => "",
		),
		"FILTER_OFFERS_PROPERTY_CODE" => array(	// Свойства предложений
			0 => "",
			1 => "",
		),
		"FILTER_PRICE_CODE" => array(	// Тип цены
			0 => "BASE",
		),
		"FILTER_PROPERTY_CODE" => array(	// Свойства
			0 => "",
			1 => "",
		),
		"FILTER_VIEW_MODE" => "VERTICAL",	// Вид отображения умного фильтра
		"FORUM_ID" => "",
		"GROUP_PRICE_COUNT" => "count",	// Группировать диапазоны по
		"HIDE_NOT_AVAILABLE" => "N",	// Товары, которых нет на складах
		"HIDE_OFFERS_LIST" => "N",
		"IBLOCK_ID" => "12",	// Инфоблок
		"IBLOCK_TYPE" => "catalog",	// Тип инфоблока
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"LABEL_PROP" => "-",
		"LINE_ELEMENT_COUNT" => "3",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",	// URL на страницу, где будет показан список связанных элементов
		"LINK_IBLOCK_ID" => "13",	// ID инфоблока, элементы которого связаны с текущим элементом
		"LINK_IBLOCK_TYPE" => "content",	// Тип инфоблока, элементы которого связаны с текущим элементом
		"LINK_PROPERTY_SID" => "ACCESSORIES",	// Свойство, в котором хранится связь
		"LIST_BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства раздела
		"LIST_META_DESCRIPTION" => "-",	// Установить описание страницы из свойства раздела
		"LIST_META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства раздела
		"LIST_OFFERS_FIELD_CODE" => array(	// Поля предложений
			0 => "NAME",
			1 => "",
		),
		"LIST_OFFERS_LIMIT" => "5",	// Максимальное количество предложений для показа (0 - все)
		"LIST_OFFERS_PROPERTY_CODE" => array(	// Свойства предложений
			0 => "",
			1 => "",
		),
		"LIST_PROPERTY_CODE" => array(	// Свойства
			0 => "",
			1 => "",
		),
		"MAIN_TITLE" => "Наличие на складах",	// Заголовок блока
		"MESSAGES_PER_PAGE" => "10",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_COMPARE" => "Сравнение",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"MIN_AMOUNT" => "10",
		"OFFERS_CART_PROPERTIES" => array(	// Свойства предложений, добавляемые в корзину
			0 => "SIZE",
		),
		"OFFERS_SORT_FIELD" => "shows",	// По какому полю сортируем предложения товара
		"OFFERS_SORT_FIELD2" => "shows",	// Поле для второй сортировки предложений товара
		"OFFERS_SORT_ORDER" => "asc",	// Порядок сортировки предложений товара
		"OFFERS_SORT_ORDER2" => "asc",	// Порядок второй сортировки предложений товара
		"OFFERS_VIEW" => "CHOISE",	// Представление предложений
		"OFFER_ADD_PICT_PROP" => "-",	// Дополнительные картинки предложения
		"OFFER_PRICE_SHOW_FROM" => "Y",	// Выводить от для цен товаров с торговыми предложениями
		"OFFER_TREE_PROPS" => "",	// Свойства для отбора предложений
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"PAGER_TITLE" => "Товары",	// Название категорий
		"PAGE_ELEMENT_COUNT" => "12",	// Количество элементов на странице
		"PARTIAL_PRODUCT_PROPERTIES" => "N",	// Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
		"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
		"PRICE_CODE" => array(	// Тип цены
			0 => "BASE",
		),
		"PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
		"PRICE_VAT_SHOW_VALUE" => "N",	// Отображать значение НДС
		"PRODUCT_DISPLAY_MODE" => "Y",	// Схема отображения
		"PRODUCT_ID_VARIABLE" => "id",	// Название переменной, в которой передается код товара для покупки
		"PRODUCT_PROPERTIES" => "",	// Характеристики товара, добавляемые в корзину
		"PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",	// Название переменной, в которой передается количество товара
		"REVIEW_AJAX_POST" => "N",
		"SECTIONS_SHOW_PARENT_NAME" => "Y",	// Показывать название раздела
		"SECTIONS_VIEW_MODE" => "LIST",	// Вид списка подразделов
		"SECTION_COUNT_ELEMENTS" => "Y",	// Показывать количество элементов в разделе
		"SECTION_ID_VARIABLE" => "SECTION_CODE",	// Название переменной, в которой передается код группы
		"SECTION_TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
		"SEF_FOLDER" => "/brands/",	// Каталог ЧПУ (относительно корня сайта)
		"SEF_MODE" => "Y",	// Включить поддержку ЧПУ
		"SET_STATUS_404" => "Y",	// Устанавливать статус 404
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SHOW_CATALOG_QUANTITY" => "N",	// Выводить информацию о наличии товара на складе
		"SHOW_CATALOG_QUANTITY_CNT" => "N",	// Выводить информацию о количестве товара на складе
		"SHOW_DESCRIPTION_AFTER_SECTION" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "Y",	// Показывать процент скидки
		"SHOW_LEFT_CATALOG_MENU" => "Y",
		"SHOW_LINK_TO_FORUM" => "N",
		"SHOW_OLD_PRICE" => "Y",	// Показывать старую цену
		"SHOW_PRICE_COUNT" => "0",	// Выводить цены для количества
		"SHOW_PRICE_NAME" => "Y",	// Выводить названия типов цен
		"SHOW_TOP_ELEMENTS" => "Y",
		"STORE_PATH" => "/company/#store_id#/",	// Шаблон пути к каталогу STORE (относительно корня)
		"TEMPLATE_THEME" => "site",
		"TOP_ELEMENT_COUNT" => "2",
		"TOP_ELEMENT_SORT_FIELD" => "shows",
		"TOP_ELEMENT_SORT_FIELD2" => "shows",
		"TOP_ELEMENT_SORT_ORDER" => "asc",
		"TOP_ELEMENT_SORT_ORDER2" => "asc",
		"TOP_LINE_ELEMENT_COUNT" => "3",
		"TOP_OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"TOP_OFFERS_LIMIT" => "5",
		"TOP_OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"TOP_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"TOP_ROTATE_TIMER" => "30",
		"TOP_VIEW_MODE" => "BANNER",
		"URL_TEMPLATES_READ" => "",
		"USE_ALSO_BUY" => "Y",	// Показывать блок "С этим товаром покупают"
		"USE_CAPTCHA" => "Y",
		"USE_COMPARE" => "Y",	// Разрешить сравнение товаров
		"USE_ELEMENT_COUNTER" => "Y",	// Использовать счетчик просмотров
		"USE_FILTER" => "Y",	// Показывать фильтр
		"USE_MIN_AMOUNT" => "N",	// Показывать вместо точного количества информацию о достаточности
		"USE_PRICE_COUNT" => "N",	// Использовать вывод цен с диапазонами
		"USE_PRODUCT_QUANTITY" => "Y",	// Разрешить указание количества товара
		"USE_REVIEW" => "Y",
		"USE_STORE" => "Y",	// Показывать блок "Количество товара на складе"
		"USE_STORE_PHONE" => "Y",
		"USE_STORE_SCHEDULE" => "Y",
		"ZOOM_ON" => "Y",	// Включить увеличение изображение при наведении
		"QTY_SHOW_TYPE" => "NUM",	// Тип вывода количества остатков
		"IN_STOCK" => "В наличии",	// Текст для товара в наличии
		"NOT_IN_STOCK" => "Нет в наличии",	// Текст для отсутствующего товара
		"QTY_MANY_GOODS_INT" => "3",	// С какого числа считать, что товара много
		"QTY_MANY_GOODS_TEXT" => "много",	// Текст для большого количества товара
		"QTY_LESS_GOODS_TEXT" => "мало",	// Текст для малого количества товара
		"COMMON_SHOW_CLOSE_POPUP" => "N",
		"DETAIL_BLOG_EMAIL_NOTIFY" => "N",
		"SIDEBAR_SECTION_SHOW" => "Y",	// Показывать правый блок в списке товаров
		"SIDEBAR_DETAIL_SHOW" => "Y",	// Показывать правый блок на детальной странице
		"SIDEBAR_PATH" => "",	// Путь к включаемой области для вывода информации в правом блоке
		"USE_MAIN_ELEMENT_SECTION" => "N",	// Использовать основной раздел для показа элемента
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"USE_SALE_BESTSELLERS" => "Y",	// Показывать список лидеров продаж
		"COMPARE_POSITION_FIXED" => "Y",	// Отображать список сравнения поверх страницы
		"COMPARE_POSITION" => "top left",	// Положение на странице
		"USE_COMMON_SETTINGS_BASKET_POPUP" => "N",	// Одинаковые настройки показа кнопок добавления в корзину или покупки на всех страницах
		"COMMON_ADD_TO_BASKET_ACTION" => "",	// Показывать кнопку добавления в корзину или покупки
		"TOP_ADD_TO_BASKET_ACTION" => "BUY",	// Показывать кнопку добавления в корзину или покупки на странице с top'ом товаров
		"SECTION_ADD_TO_BASKET_ACTION" => "BUY",	// Показывать кнопку добавления в корзину или покупки на странице списка товаров
		"DETAIL_ADD_TO_BASKET_ACTION" => "",	// Показывать кнопки добавления в корзину и покупки на детальной странице товара
		"DETAIL_SHOW_BASIS_PRICE" => "Y",	// Показывать на детальной странице цену за единицу товара
		"SECTION_BACKGROUND_IMAGE" => "-",	// Установить фоновую картинку для шаблона из свойства
		"DETAIL_SET_CANONICAL_URL" => "N",	// Устанавливать канонический URL
		"DETAIL_BACKGROUND_IMAGE" => "-",
		"SHOW_DEACTIVATED" => "N",	// Показывать деактивированные товары
		"USE_BIG_DATA" => "Y",	// Показывать персональные рекомендации
		"BIG_DATA_RCM_TYPE" => "bestsell",	// Тип рекомендации
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"SHOW_404" => "N",	// Показ специальной страницы
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"PREVIEW_DETAIL_PROPERTY_CODE" => array(	// Свойства для показа в анонсе
			0 => "",
			1 => "",
		),
		"SHOW_LEFT_MENU_SETTINGS" => "Y",
		"STORES" => "",	// Склады
		"USER_FIELDS" => array(	// Пользовательские поля
			0 => "",
			1 => "",
		),
		"FIELDS" => array(	// Поля
			0 => "",
			1 => "",
		),
		"SHOW_EMPTY_STORE" => "Y",	// Отображать склад при отсутствии на нем товара
		"SHOW_GENERAL_STORE_INFORMATION" => "Y",	// Показывать общую информацию по складам
		"ROOT_MENU_TYPE" => "left",	// Тип меню для первого уровня
		"MAX_LEVEL" => "1",	// Уровень вложенности меню
		"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
		"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
		"DELAY" => "N",	// Откладывать выполнение шаблона меню
		"LEFT_MENU_TEMPLATE" => "left",	// Шаблон левого меню
		"TITLE_MENU" => "Каталог",	// Заголовок меню
		"STYLE_MENU" => "colored_light",	// Cтиль меню
		"PICTURE_SECTION" => "N",	// Картинка раздела
		"SUBMENU" => "ACTIVE_SHOW",	// Подменю
		"STYLE_MENU_HOVER" => "colored_light",
		"HANDLERS" => array(
			0 => "lj",
			1 => "twitter",
			2 => "vk",
			3 => "facebook",
			4 => "mailru",
			5 => "delicious",
		),
		"SHORTEN_URL_LOGIN" => "",
		"SHORTEN_URL_KEY" => "",
		"ALSO_BUY_TITLE" => "С этим товаром покупают",	// Заголовок блока с этим товаром покупают
		"TOP_TITLE" => "Лидеры продаж",
		"BESTSALLERS_TITLE" => "Лидеры продаж",	// Заголовок блока с этим лидеры продаж
		"BESTSALLERS_CNT" => "4",	// Количество элементов в блоке лидеры продаж
		"BIG_DATA_TITLE" => "Персональные рекомендации",	// Заголовок блока персональные рекомендации
		"BIG_DATA_CNT" => "4",	// Количество элементов в блоке персональные рекомендации
		"VIEWED_PRODUCTS_BLOCK_TITLE" => "Просмотренные товары",	// Заголовок блока просмотренные товары
		"VIEWED_PRODUCTS_CNT" => "3",	// Количество элементов в блоке просмотренные товары
		"BESTSALLERS_WERE_SHOW" => "bottom",	// Где показывать блок лидеры продаж
		"VIEWED_PRODUCTS_SHOW" => "Y",	// Показывать блок просмотренные товары
		"VIEWED_PRODUCTS_WERE_SHOW" => "left",	// Где показывать блок просмотренные товары
		"BESTSALLERS_SORT" => "200",	// Сортировка блока лидеры продаж
		"VIEWED_PRODUCTS_SORT" => "100",	// Сортировка блока просмотренные товары
		"SHOW_SECTION_DESC" => "top",	// Показывать описание раздела
		"SKU_PROPS_SHOW_TYPE" => "rounded",	// Тип отображения свойств предложений
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина названия элемента для вывода
		"ANOUNCE_TRUNCATE_LEN" => "",	// Максимальная длина анонса элемента для вывода (только для типа Текст)
		"TILE_SHOW_PROPERTIES" => "N",	// Выводить выбранные свойства в режиме Плитка
		"THEME" => "default",	// Тема оформления
		"CATALOG_DEFAULT_SORT" => "PROPERTY_MINIMUM_PRICE",	// Сортировка по-умолчанию
		"PAGE_ELEMENT_COUNT_SHOW" => "Y",	// Показывать ограничение по количеству элементов
		"CATALOG_VIEW_SHOW" => "Y",	// Показывать варианты отображения каталога
		"USE_GIFTS_DETAIL" => "N",	// Показывать блок "Подарки" в детальном просмотре
		"USE_GIFTS_SECTION" => "N",	// Показывать блок "Подарки" в списке
		"GIFTS_HIDE_NOT_AVAILABLE" => "N",	// Не отображать подарки, которых нет на складах
		"RESTART" => "N",	// Искать без учета морфологии (при отсутствии результата поиска)
		"NO_WORD_LOGIC" => "N",	// Отключить обработку слов как логических операторов
		"USE_LANGUAGE_GUESS" => "Y",	// Включить автоопределение раскладки клавиатуры
		"CHECK_DATES" => "N",	// Искать только в активных по дате документах
		"CURRENCY_ID" => "RUB",	// Валюта, в которую будут сконвертированы цены
		"PAGE_ELEMENT_COUNT_LIST" => array(	// Варианты количества элементов на странице
			0 => "",
			1 => "",
		),
		"DEFAULT_CATALOG_VIEW" => "TITLE",	// Вид каталога по-умолчанию
		"DETAIL_STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для детального показа элемента
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"SEF_URL_TEMPLATES" => array(
			"sections" => "",
			"section" => "#SECTION_CODE#/",
			"element" => "/catalog/#SECTION_CODE#/#ELEMENT_CODE#",
			"compare" => "compare.php?action=#ACTION_CODE#",
			"smart_filter" => "#BRAND_CODE#/",
		),
		"VARIABLE_ALIASES" => array(
			"compare" => array(
				"ACTION_CODE" => "action",
			),
		)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>