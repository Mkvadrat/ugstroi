<?php
define('WP_AUTO_UPDATE_CORE', false);// This setting was defined by WordPress Toolkit to prevent WordPress auto-updates. Do not change it to avoid conflicts with the WordPress Toolkit auto-updates feature.
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'ugstroi');

/** Имя пользователя MySQL */
define('DB_USER', 'ugstroi');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'Fjx4?6u9');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'NyFC9A2FZwDKgC=W@KitV@uy2T0|+)R*U^Hsm//JL|!n&/k_mYVvBnF(qQKiXXYm');
define('SECURE_AUTH_KEY',  ':m9p$yp)^^wYv|%nnv+GD26#g6ZX~##87aD0Bs6t-6>Q1R*`C%ptR*H`fqK;MrNX');
define('LOGGED_IN_KEY',    '~~~X8Gd^y Z&w<1kArO*b&ahlt=rwTAuB~mW67?<rMZRT}7>+})_AK~Q#h._hmoU');
define('NONCE_KEY',        'bD+$s_e,,}olSHj>6WkKNq2)SO7K8K=JLe*@p49rq6wgdC|Qm9Ex,m_V2.>2|1N,');
define('AUTH_SALT',        'UpQ&u`z=tKeid>DyrgxJ`_w5@HjyfDjG^OPJdvbsC3ExE)NEYXr;MxkW)?vjj;A0');
define('SECURE_AUTH_SALT', '#TZR;rG</:m@YE>]kdECh93.BNAq-:n6xQ&VN&l|(z^Msvi73bToHC4N8B}O)*?+');
define('LOGGED_IN_SALT',   'r6^v/2,]$}G>O>N:Bg <dRN}Jcee2L*(~peRHezjCLH.{(]z`3#HO,cs{rd48JjD');
define('NONCE_SALT',       '++BKE.MCB[I5s$-vjCuD7FYBM^r=(fn? <,^o4yIxRe9v~dfYD^j`|T!X1CJMf2M');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'ru_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 * 
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
