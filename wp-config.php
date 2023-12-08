<?php
/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи и ABSPATH. Дополнительную информацию можно найти на странице
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется скриптом для создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения вручную.
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/var/www/www-root/data/www/vr-j.ru/wp-content/plugins/wp-super-cache/' );
define('DB_NAME', 'mirora_vrj');

/** Имя пользователя MySQL */
define('DB_USER', 'mirora_vrj');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'KLlT6&Sa');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

// define('DISABLE_WP_CRON', true);

define('ENABLE_CACHE', true );
define('CACHE_EXPIRATION_TIME', 900);


/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'f(|!s!}00T6,H&-:AyJ#XDAx{{Rx|fn>Y7<IK@3H,Bt*XF)]sQ,/^+m.ES1^;.&=');
define('SECURE_AUTH_KEY',  '+f8G6 qF/Q`44J)$3#]6.}(`~DgUj]|FqWbq7$cSJ6vpO[|eM/g` 5Kl H@q+.eU');
define('LOGGED_IN_KEY',    ']?[,t=Pva9?&^.|L~N!CDJ*U)Ri8fh|O.Z5)u*j[-y)X)|3Tj/Wq|m4B}|lLOrtJ');
define('NONCE_KEY',        'mgfun2O|{fq GkHT||+kt&i~_Hy5wqZ4*2b1?/,snxY5VFcwpH4zy%=i[|ZX_ iU');
define('AUTH_SALT',        '_;wjl%>A%{##E2pW0eMlGzV9Tb2J5OP%~bz0KE?f~=[%[g(Y+?6p?[8qqv$EJR57');
define('SECURE_AUTH_SALT', 'WS|/LmM!1C:S(ICj5qB!0/Iug1Rcd^S>VUfhBblc{<~U#0X%($j;BP(iv-_Y0e*8');
define('LOGGED_IN_SALT',   'Lh-] w(9kj{0-acTBm;,bU(2sdd.~CQ%I]<z{[4TvCmw{H|ruE$gbREndB8Us}hu');
define('NONCE_SALT',       '36^G$yUla}F04;4^16izCMH/_U=oxW];t>6NTJuA9c]v1`Phx5w<+4BHOmv.9&`a');

/**#@-*/

/** 
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'ulit1_';

/**
 * Для разработчиков: Режим отладки WordPress.
 * 
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 */
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', false);
define( 'WP_DEBUG_DISPLAY', false );
define('WP_POST_REVISIONS', 5);
define('AUTOSAVE_INTERVAL', 300);


/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
?>
