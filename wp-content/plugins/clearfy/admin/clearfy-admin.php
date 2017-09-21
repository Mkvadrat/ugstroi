<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @since      0.9.0
 * @package    Clearfy
 * @author     WPShop.biz <support@wpshop.biz>
 * @build      ###built###
 */
class Clearfy_Plugin_Admin {
    /**
     * Option name
     *
     * @var string
     */
    protected $option_name = 'clearfy_option';

    /**
     * All options
     *
     * @var mixed|void
     */
    protected $options;

    /**
     * Api url
     *
     * @var string
     */
    protected $api_url;

    /**
     * Plugin path
     *
     * @var string
     */
    protected $plugin_path;

    /**
     * Link to settings page
     *
     * @var string
     */
    protected $settings_link;

    /**
     * Initialize the class and set its properties.
     *
     * @since    0.9.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     * @param      string    $api_url    The api url
     * @param      string    $plugin_path    Plugin path
     */
    public function __construct( $plugin_name, $version, $api_url, $plugin_path ) {
        $this->plugin_name      = $plugin_name;
        $this->version          = $version;
        $this->api_url          = $api_url;
        $this->plugin_path      = $plugin_path;
        $this->settings_link    = admin_url( 'options-general.php?page=clearfy' );

        $this->options = get_option($this->option_name);

        /**
         * Admin menu and settings
         */
        add_action( 'admin_menu', array( $this, 'create_admin_menu' ) );
        add_action( 'admin_init', array( $this, 'register_clearfy_settings' ) );

        /**
         * Add css and js files
         */
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );


        // plugin settings link
        add_filter( "plugin_action_links_$this->plugin_path", array( $this, 'plugin_add_settings_link' ) );

        /**
         * License activate
         */
        add_action( 'admin_init', array( $this, 'activate_license' ) );
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    0.9.5
     */
    public function enqueue_styles() {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Plugin_Name_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Plugin_Name_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/clearfy-admin.css', array(), $this->version, 'all');
    }
    /**
     * Register the JavaScript for the admin area.
     *
     * @since    0.9.5
     */
    public function enqueue_scripts() {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Plugin_Name_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Plugin_Name_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/clearfy-admin.js', array('jquery'), $this->version, false);
    }


    /**
     * Add settings link in plugins list
     *
     * @param $links
     * @return mixed
     */
    public function plugin_add_settings_link( $links ) {
        $settings_link = '<a href="' . $this->settings_link . '">' . __( 'Settings' ) . '</a>';
        array_unshift( $links, $settings_link );
        return $links;
    }


    /**
     * Add plugin settings menu link
     */
    public function create_admin_menu() {
        add_menu_page( 'Clearfy Settings', 'Clearfy', 'manage_options', 'clearfy', array( $this, 'admin_page_display' ), $this->get_menu_svg(), "99.42" );
        add_submenu_page( 'clearfy', 'Список изменений', 'Список изменений', 'manage_options', 'clearfy_changelog', array( $this, 'changelog_display' ));
        add_submenu_page( 'clearfy', 'FAQ', 'FAQ', 'manage_options', 'clearfy_faq', array( $this, 'faq_display' ));

        /**
         * Change name
         */
        global $submenu;
        if ( isset( $submenu['clearfy'] ) && current_user_can( 'manage_options' ) ) {
            $submenu['clearfy'][0][0] = 'Основные';
        }
    }

    /**
     * Returns a base64 URL for the svg for use in the menu
     *
     * @return string
     */
    private function get_menu_svg() {
        $icon_svg = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiBwcmVzZXJ2ZUFzcGVjdFJhdGlvPSJ4TWlkWU1pZCIgd2lkdGg9IjM3NiIgaGVpZ2h0PSIzMDIiIHZpZXdCb3g9IjAgMCAzNzYgMzAyIj4KICA8ZGVmcz4KICAgIDxzdHlsZT4KCiAgICAgIC5jbHMtMiB7CiAgICAgICAgZmlsbDogIzAwMDAwMDsKICAgICAgfQogICAgPC9zdHlsZT4KICA8L2RlZnM+CiAgPHBhdGggZD0iTTM3Ni4yNDIsODguOTMyIEMzNzYuMjQyLDg4LjkzMiAzNzEuOTIwLDkyLjE4MSAzNzEuOTIwLDkyLjE4MSBDMzcxLjkyMCw5Mi4xODEgMzcyLjA2OSw5Mi4zMTMgMzcyLjA2OSw5Mi4zMTMgQzM3Mi4wNjksOTIuMzEzIDE4Ny4zODUsMzAwLjgyOSAxODcuMzg1LDMwMC44MjkgQzE4Ny4zODUsMzAwLjgyOSAxODYuNjk3LDMwMS45NjEgMTg2LjY5NywzMDEuOTYxIEMxODYuNjk3LDMwMS45NjEgMTg2LjU0MCwzMDEuNzgzIDE4Ni41NDAsMzAxLjc4MyBDMTg2LjU0MCwzMDEuNzgzIDE4Ni4zODIsMzAxLjk2MSAxODYuMzgyLDMwMS45NjEgQzE4Ni4zODIsMzAxLjk2MSAxODUuNjk2LDMwMC44MzEgMTg1LjY5NiwzMDAuODMxIEMxODUuNjk2LDMwMC44MzEgMC4wMTEsOTEuMzEzIDAuMDExLDkxLjMxMyBDMC4wMTEsOTEuMzEzIDEuMDcyLDkwLjQ5NiAxLjA3Miw5MC40OTYgQzEuMDcyLDkwLjQ5NiAwLjI1Nyw4OS45MzIgMC4yNTcsODkuOTMyIEMwLjI1Nyw4OS45MzIgNjEuODIwLDEuMDAwIDYxLjgyMCwxLjAwMCBDNjEuODIwLDEuMDAwIDYyLjQ4NywxLjQ2MiA2Mi40ODcsMS40NjIgQzYyLjQ4NywxLjQ2MiA2Mi40MTUsLTAuMDAwIDYyLjQxNSwtMC4wMDAgQzYyLjQxNSwtMC4wMDAgMzE0LjA4NCwtMC4wMDAgMzE0LjA4NCwtMC4wMDAgQzMxNC4wODQsLTAuMDAwIDMxNC4wMTMsMS40NjIgMzE0LjAxMywxLjQ2MiBDMzE0LjAxMywxLjQ2MiAzMTQuNjgwLDEuMDAwIDMxNC42ODAsMS4wMDAgQzMxNC42ODAsMS4wMDAgMzc2LjI0Miw4OC45MzIgMzc2LjI0Miw4OC45MzIgWk0zMDcuMDM0LDI2LjAxMCBDMzA3LjAzNCwyNi4wMTAgMjcyLjY5NCw3OC42NzAgMjcyLjY5NCw3OC42NzAgQzI3Mi42OTQsNzguNjcwIDM0My40ODgsNzguNjcwIDM0My40ODgsNzguNjcwIEMzNDMuNDg4LDc4LjY3MCAzMDcuMDM0LDI2LjAxMCAzMDcuMDM0LDI2LjAxMCBaTTMzOC42MTIsOTkuMTkzIEMzMzguNjEyLDk5LjE5MyAyNjIuMjE2LDk5LjE5MyAyNjIuMjE2LDk5LjE5MyBDMjYyLjIxNiw5OS4xOTMgMjExLjg3MiwyNDIuNjg1IDIxMS44NzIsMjQyLjY4NSBDMjExLjg3MiwyNDIuNjg1IDMzOC42MTIsOTkuMTkzIDMzOC42MTIsOTkuMTkzIFpNMTg2LjU0MCwyNTIuOTA1IEMxODYuNTQwLDI1Mi45MDUgMjQwLjQ2OCw5OS4xOTMgMjQwLjQ2OCw5OS4xOTMgQzI0MC40NjgsOTkuMTkzIDEzMi42MTEsOTkuMTkzIDEzMi42MTEsOTkuMTkzIEMxMzIuNjExLDk5LjE5MyAxODYuNTQwLDI1Mi45MDUgMTg2LjU0MCwyNTIuOTA1IFpNMTYxLjIwNywyNDIuNjg2IEMxNjEuMjA3LDI0Mi42ODYgMTEwLjg2NCw5OS4xOTMgMTEwLjg2NCw5OS4xOTMgQzExMC44NjQsOTkuMTkzIDM0LjQ2OCw5OS4xOTMgMzQuNDY4LDk5LjE5MyBDMzQuNDY4LDk5LjE5MyAxNjEuMjA3LDI0Mi42ODYgMTYxLjIwNywyNDIuNjg2IFpNMzMuMDExLDc4LjY3MCBDMzMuMDExLDc4LjY3MCAxMDAuMzg2LDc4LjY3MCAxMDAuMzg2LDc4LjY3MCBDMTAwLjM4Niw3OC42NzAgNjcuNzA0LDI4LjU1NCA2Ny43MDQsMjguNTU0IEM2Ny43MDQsMjguNTU0IDMzLjAxMSw3OC42NzAgMzMuMDExLDc4LjY3MCBaTTg2Ljk2NiwyMC41MjMgQzg2Ljk2NiwyMC41MjMgMTIwLjE2Miw3MS40MjggMTIwLjE2Miw3MS40MjggQzEyMC4xNjIsNzEuNDI4IDE2NC4xMjEsMjAuNTIzIDE2NC4xMjEsMjAuNTIzIEMxNjQuMTIxLDIwLjUyMyA4Ni45NjYsMjAuNTIzIDg2Ljk2NiwyMC41MjMgWk0xNDEuMDIyLDc4LjY3MCBDMTQxLjAyMiw3OC42NzAgMjMyLjA1Nyw3OC42NzAgMjMyLjA1Nyw3OC42NzAgQzIzMi4wNTcsNzguNjcwIDE4Ni41NDAsMjUuOTYwIDE4Ni41NDAsMjUuOTYwIEMxODYuNTQwLDI1Ljk2MCAxNDEuMDIyLDc4LjY3MCAxNDEuMDIyLDc4LjY3MCBaTTIwOC45NTgsMjAuNTIzIEMyMDguOTU4LDIwLjUyMyAyNTIuOTE4LDcxLjQyOCAyNTIuOTE4LDcxLjQyOCBDMjUyLjkxOCw3MS40MjggMjg2LjExMywyMC41MjMgMjg2LjExMywyMC41MjMgQzI4Ni4xMTMsMjAuNTIzIDIwOC45NTgsMjAuNTIzIDIwOC45NTgsMjAuNTIzIFoiIGlkPSJwYXRoLTEiIGNsYXNzPSJjbHMtMiIgZmlsbC1ydWxlPSJldmVub2RkIi8+Cjwvc3ZnPgo=';

        return $icon_svg;
    }


    /**
     * Register settings
     */
    public function register_clearfy_settings() {
        register_setting( 'clearfy_settings', $this->option_name, array( $this, 'sanitize_clearfy_options' ) );
        register_setting( 'clearfy_license', 'clearfy_license_key' );
    }

    public function sanitize_clearfy_options( $options ) {
        return $options;
    }


    public function activate_license() {
        // listen for our activate button to be clicked
        if( isset( $_POST['clearfy_license_key'] ) && ! empty( $_POST['clearfy_license_key'] ) ) {
            /**
             * Remove updater cache in DB
             */
            delete_option(Clearfy_Plugin::CHECK_UPDATE_OPTION);

            // run a quick security check
            //if( ! check_admin_referer( 'edd_sample_nonce', 'edd_sample_nonce' ) )
            //    return; // get out if we didn't click the Activate button

            // retrieve the license from the database
            $license = trim( $_POST[ 'clearfy_license_key'] );

            // data to send in our API request
            $api_params = array(
                'action'    => 'activate_license',
                'license' 	=> $license,
                'item_name' => urlencode( $this->plugin_name ), // the name of our product in EDD,
                'version'   => $this->version,
                'type'      => 'plugin',
			    'url'       => home_url(),
		    );

            // Call the custom API.
            $response = wp_remote_post( $this->api_url, array(
                'timeout'   => 15,
                'sslverify' => false,
                'body'      => $api_params
            ) );
            // make sure the response came back okay
            if ( is_wp_error( $response ) )
                return false;

            // decode the license data
            $license_data = wp_remote_retrieve_body( $response );
            if (mb_substr($license_data, 0, 2) == 'ok') {
                update_option( 'license_verify', time() + (WEEK_IN_SECONDS * 4) );
                delete_option( 'license_error' );
            } else {
                update_option( 'license_error', $license_data );
            }

            // $license_data->license will be either "active" or "inactive"
            //update_option( 'license_verify', $license_data->license );
	    }
    }


    /**
     * Check version
     *
     * @return bool
     */
    public function check_version() {
       /* $api_params = array(
            'action'    => 'check_version',
            'item_name' => urlencode( $this->plugin_name ),
            'version'   => $this->version,
            'url'       => home_url(),
        );

        $response = wp_remote_post( $this->api_url, array(
            'timeout'   => 15,
            'sslverify' => false,
            'body'      => $api_params
        ) );

        if ( is_wp_error( $response ) )
            return false;

        // decode the license data
        $license_data = wp_remote_retrieve_body( $response );
        if (!empty($license_data)) return $license_data;*/

        return false;
    }


    /**
     * Display changelog page
     */
    public function changelog_display() {

        ?>
        <div class="wrap">

            <h1>Список изменений</h1>

            <div class="clearfy-changelog">
                <div class="clearfy-changelog__item">
                    <strong class="clearfy-changelog__version" title="26.04.2017">1.0.7</strong>
                    <ul>
                        <li>Добавлена: возможность исключить из Last-Modified страницы</li>
                        <li>Добавлена: возможность удалить ?replytocom из комментариев и поставить редирект</li>
                        <li>Доработана: ф-ция удаления комментариев Yoast SEO</li>
                        <li>Изменен: адрес сервера лицензий</li>
                    </ul>
                </div>
                <div class="clearfy-changelog__item">
                    <strong class="clearfy-changelog__version" title="09.02.2017">1.0.6</strong>
                    <ul>
                        <li>Исправлено: редирект у авторов а админке</li>
                    </ul>
                </div>
                <div class="clearfy-changelog__item">
                    <strong class="clearfy-changelog__version" title="08.02.2017">1.0.5</strong>
                    <ul>
                        <li>Добавлено: минификация HTML</li>
                        <li>Добавлено: возможность удалить &lt;image:image&gt; в XML карте плагина Yoast SEO</li>
                        <li>Добавлено: удаляет комментарий плагина Yoast SEO в секции &lt;head&gt;</li>
                        <li>Исправлено: разделены ф-ции "Удалить архивы пользователей" и "Убрать возможность узнать логин администратора"</li>
                        <li>Исправлена: предупреждение в robots.txt get_headers() http:// wrapper is disabled</li>
                        <li>Исправлено: /feed у записей, архивов и пр. теперь редиректит на саму запись, а не на главную</li>
                        <li>Исправлено: у сайтов с HTTPS теперь правильная директива Host в robots с https</li>
                        <li>Исправлены: мелкие ошибки</li>
                        <li>Обновлено: логотипы в плагине переведены на https</li>
                        <li>Обновлен: создаваемый robots.txt</li>
                        <li>Удалена: ф-ция редиректа http -> https</li>
                    </ul>
                </div>
                <div class="clearfy-changelog__item">
                    <strong class="clearfy-changelog__version" title="15.11.2016">1.0.4</strong>
                    <ul>
                        <li>Исправлено: небольшой баг с robots.txt</li>
                    </ul>
                </div>
                <div class="clearfy-changelog__item">
                    <strong class="clearfy-changelog__version" title="15.11.2016">1.0.3</strong>
                    <ul>
                        <li>Добавлено: возможность задать свой robots.txt</li>
                        <li>Добавлено: новый внешний вид настроек</li>
                        <li>Исправлено: редирект автора в админке</li>
                        <li>Исправлено: мелкие баги</li>
                    </ul>
                </div>
                <div class="clearfy-changelog__item">
                    <strong class="clearfy-changelog__version" title="28.09.2016">1.0.2</strong>
                    <ul>
                        <li>Добавлено: удаление ссылок dns-prefetch из секции head</li>
                        <li>Добавлено: файл readme.txt, теперь перед обновлением можно посмотреть все изменения</li>
                        <li>Добавлено: При сохранении появляется сообщение о том, что настройки сохранены</li>
                        <li>Исправлено: позиция у меню из-за которой с некоторыми плагинами возникал конфликт</li>
                    </ul>
                </div>
                <div class="clearfy-changelog__item">
                    <strong class="clearfy-changelog__version" title="01.06.2016">1.0.1</strong>
                    <ul>
                        <li>Исправлено: редирект в админке при выборе фильтра даты</li>
                    </ul>
                </div>
                <div class="clearfy-changelog__item">
                    <strong class="clearfy-changelog__version">1.0.0</strong>
                    <ul>
                        <li>Добавлено: Last Modified и If-Modified-Since теперь работает и для Страниц (page)</li>
                        <li>Добавлено: If-Modified-Since теперь работает только для неавторизованных пользователей</li>
                        <li>Добавлено: фильтр убирающий meta generator, старый способ не всегда срабатывал</li>
                        <li>Добавлено: правила в robots.txt, разрешающие доступ к css и js файлам (проблема гугл-бота, который не мог получить доступ)</li>
                        <li>Добавлено: страница FAQ</li>
                        <li>Добавлено: дополнительая обработка пустого alt аттрибута у картинок</li>
                        <li>Исправлено: работа псевдо-ссылок в виджете "последние комментарии" у авторов комментариев</li>
                        <li>Исправлено: правильная ссылка на настройки плагина на странице плагинов</li>
                        <li>Исправлено: сделаны уникальные названия классов, т.к. существующие конфликтовали с WP</li>
                        <li>Исправлено: подключение стилей и скриптов теперь не вызывает Notice</li>
                    </ul>
                </div>

                <div class="clearfy-changelog__item">
                    <strong class="clearfy-changelog__version">0.9.8</strong>
                    <ul>
                        <li>Добавлено: удаляет короткую ссылку shortlink из заголовков ответа сервера</li>
                        <li>Добавлено: обработка If-Modified-Since, если страница не менялась - отдает ответ 304 Not Modified</li>
                    </ul>
                </div>

                <div class="clearfy-changelog__item">
                    <strong class="clearfy-changelog__version">0.9.7</strong>
                    <ul>
                        <li>Добавлено: автоматическая простановка Last Modified</li>
                        <li>Добавлено: еще один способ убрать X-Pingback из заголовков, т.к. с прошлый в новых версиях перестал работать</li>
                        <li>Исправлено: функция удаления дублей пагинации страниц для главной страницы</li>
                    </ul>
                </div>

                <div class="clearfy-changelog__item">
                    <strong class="clearfy-changelog__version">0.9.6</strong>
                    <ul>
                        <li>файлы плагина css и js теперь подключаются только в админке</li>
                        <li>настройки плагина вынесены отдельным пунктом меню</li>
                        <li>удален changelog из файла плагина и перемещен на отдельную страницу</li>
                    </ul>
                </div>

                <div class="clearfy-changelog__item">
                    <strong class="clearfy-changelog__version">0.9.5</strong>
                    <ul>
                        <li>добавлен функционал <strong>Ограничения ревизий</strong></li>
                        <li>добавлено автоматическое обновление плагина</li>
                        <li>добавлена ссылка "Настройки" у Clearfy на странице установленных плагинов</li>
                        <li>все настройки теперь разбиты по вкладкам</li>
                        <li>теперь активная вкладка сохраняется при обновлении</li>
                        <li>все скрипты и стили вынесены в отдельные файлы</li>
                    </ul>
                </div>

                <div class="clearfy-changelog__item">
                    <strong class="clearfy-changelog__version">0.9.4</strong>
                    <ul>
                        <li>из <code>robots.txt</code> удалено правило <code>/wp-content/themes</code>, поскольку google бот не видит css и js файлы</li>
                        <li>добавлена проверка версии плагина</li>
                    </ul>
                </div>

                <div class="clearfy-changelog__item">
                    <strong class="clearfy-changelog__version">0.9.3</strong>
                    <ul>
                        <li>добавлен редирект с <code>/wp-json</code></li>
                    </ul>
                </div>

                <div class="clearfy-changelog__item">
                    <strong class="clearfy-changelog__version">0.9.2</strong>
                    <ul>
                        <li>фикс версии</li>
                    </ul>
                </div>

                <div class="clearfy-changelog__item">
                    <strong class="clearfy-changelog__version">0.9.1</strong>
                    <ul>
                        <li>фикс переменных</li>
                        <li>добавлен changelog в файл плагина</li>
                    </ul>
                </div>

                <div class="clearfy-changelog__item">
                    <strong class="clearfy-changelog__version">0.9.0</strong>
                    <ul>
                        <li>первая публичная версия</li>
                    </ul>
                </div>

            </div>

        </div>
        <?php

    }

    /**
     * Display changelog page
     */
    public function faq_display() {

        ?>
        <div class="wrap">

            <h1>FAQ</h1>

            <h2>Удалил robots.txt, а новый не создается?</h2>
            <p>Новый файл <code>robots.txt</code> виртуальный, физически он не создается на диске, но имеет такой же путь и для поисковиков никак не отличается.</p>

            <br>

            <h2>В robots.txt дублируется карта сайта (Sitemap)</h2>
            <p>Скорей всего у Вас установлен плагин <code>Google Sitemap Generator</code>. Перейдите в <code>Настройки - XML-Sitemap</code>, найдите и снимите галочку с <code>Add sitemap URL to the virtual robots.txt file.</code></p>

            <br>

            <h2>Нет редиректа с https на http</h2>
            <p>Здесь все зависит от Вашего хостера - если Ваш сайт изначально открывается по протоколу https - редирект будет работать. Но как показывает практика - хостеры не часто открывают эту возможность.</p>

        </div>
        <?php

    }


    /**
     * Display admin plugin page
     */
    public function admin_page_display() {
        $options = get_option($this->option_name);
        $license_key = get_option('clearfy_license_key');
        $license_verify = get_option('license_verify');
        $license_error = get_option('license_error');

        $check_version = $this->check_version();

        $i_o=1;
        ?>

        <div class="wrap wpshop clearfy js-clearfy">

            <h1>Clearfy</h1>

            <?php settings_errors(); ?>


            <?php if ($i_o == 2): ?>
            <?php //if ( 1==2 ): ?>

            <form method="post" action="options.php">
                <?php settings_fields( 'clearfy_license' ); ?>
                <table class="form-table">

                    <tr>
                        <th scope="row"><label for="clearfy_license_key">Лицензионный ключ</label></th>
                        <td>
                            <input name="clearfy_license_key" id="clearfy_license_key" type="text" class="regular-text" value="<?php echo $license_key ?>">
                            <?php /*if (!empty($license_error)): ?>
                                <p class="description danger"><?php echo $license_error ?></p>
                            <?php endif;*/ ?>
                        </td>
                    </tr>
                </table>

                <?php submit_button(); ?>
            </form>

            <?php else: ?>

                <?php
                /* TODO: проверка на верификацию раз в 4 недели */

                if ( ! empty($license_verify) ) {

                }
                ?>











            <h3>Настройки</h3>


            <div class="wpshop-cols">

                <div class="wpshop-col-left">

                    <div class="pseudo-button js-clearfy-enable">Отметить все</div>
                    <div class="pseudo-button pseudo-button__green js-clearfy-recommend">Только рекомендованные</div>
                    <div class="pseudo-button pseudo-button__gray js-clearfy-disable">Отключить все</div>

                    <p>Для большинства блогов мы рекомендуем включать "Только рекомендованные" настройки.<br>Если Вы опытный пользователь WordPress - настройки можно сделать вручную.</p>
                    <p><strong>Не забудьте сохранить настройки!</strong></p>


                    <form method="post" action="options.php" class="js-clearfy-form">

                        <?php settings_fields( 'clearfy_settings' ); ?>
<?php /*
                        <h2 class="nav-tab-wrapper clearfy-tab-wrapper js-tab-wrapper">
                            <a class="nav-tab nav-tab-active" id="general-tab" href="#top#general">Общая</a>
                            <a class="nav-tab" id="clear-code-tab" href="#top#clear-code">Чистка кода</a>
                            <a class="nav-tab" id="seo-tab" href="#top#seo">SEO</a>
                            <a class="nav-tab" id="double-tab" href="#top#double">Дубли страниц</a>
                            <a class="nav-tab" id="security-tab" href="#top#security">Защита</a>
                            <a class="nav-tab" id="more-tab" href="#top#more">Дополнительно</a>
                        </h2>
*/ ?>


                        <h2 class="wpshop-tab-wrapper js-wpshop-tab-wrapper">
							<a class="wpshop-tab wpshop-tab-active" id="tab-clearfy_general" href="#clearfy_general">Общая</a>
							<a class="wpshop-tab" id="tab-clearfy_clear" href="#clearfy_clear">Код</a>
							<a class="wpshop-tab" id="tab-clearfy_seo" href="#clearfy_seo">SEO</a>
							<a class="wpshop-tab" id="tab-clearfy_double" href="#clearfy_double">Дубли страниц</a>
							<a class="wpshop-tab" id="tab-clearfy_security" href="#clearfy_security">Защита</a>
							<a class="wpshop-tab" id="tab-clearfy_more" href="#clearfy_more">Дополнительно</a>
						</h2>

                        <div id="clearfy_general" class="wpshop-tab-in js-wpshop-tab-item active">

                            <h3>Инструкция</h3>
                            <p>
                                Для большинства сайтов и блогов достаточно включить Рекомендованные настройки и нажать Сохранить.
                                Но мы все таки рекомендуем Вам пройтись по каждой вкладке и изучить все возможные настройки Clearfy.
                            </p>
                            <p>Блогерам необходимо обратить особое внимание на RSS ленты. Если Вы пользуетесь ими - не отключите случайно.</p>
                            <p>Кроме выбора необходимых настроек - больше ничего делать не нужно.</p>
                            <p>При возникновении вопросов по каким-либо пунктам - не стесняйтесь задать вопрос в техническую поддержку.</p>

                            <h3>Команда WPShop.ru</h3>
                            <p>Мы благодарим Вас за приобретение Clearfy!<br>Наша цель - сделать мощный плагин, который войдет в число первых обязательных плагинов для WP.</p>

                        </div>
                        <div id="clearfy_clear" class="wpshop-tab-in js-wpshop-tab-item">
                            <h3>Чистка кода</h3>

                            <fieldset>
                                <label for="disable_json_rest_api">
                                    <?php $this->display_checkbox('disable_json_rest_api') ?>
                                    Отключить JSON REST API <sup class="clearfy-recommend">Рекомендовано</sup>
                                </label>
                                <p class="description">WP с версии 4.4 создает технические страницы /wp-json/, которые успешно индексируются поисковиками и в индекс попадают мусорные страницы.</p>
                                <p class="description"><strong>Clearfy:</strong> Удаляет ссылки из секции <code>&lt;head&gt;</code> и ставит редирект на главную.</p>
                            </fieldset>
                            <br>
                            <fieldset>
                                <label for="disable_emoji">
                                    <?php $this->display_checkbox('disable_emoji') ?>
                                    Отключить Emoji <sup class="clearfy-recommend">Рекомендовано</sup>
                                </label>
                                <p class="description">WP с версии 4.2 добавил поддержку смайликов Emoji в исходный код для старых браузеров. Используется внешняя библиотека от Twitter. В 90% случаев это лишь создает лишний код и запросы к внешним ресурсам.</p>
                                <p class="description"><strong>Clearfy:</strong> Удаляет код emoji из секции <code>&lt;head&gt;</code></p>
                            </fieldset>
                            <br>
                            <fieldset>
                                <label for="remove_meta_generator">
                                    <?php $this->display_checkbox('remove_meta_generator') ?>
                                    Удалить meta generator <sup class="clearfy-recommend">Рекомендовано</sup>
                                </label>
                                <p class="description">Позволяет злоумышленникам узнать версию WP, установленную на сайте. Этот meta тег никакой полезной функции не несет.</p>
                                <p class="description"><strong>Clearfy:</strong> Удаляет meta тег из секции <code>&lt;head&gt;</code></p>
                            </fieldset>
                            <br>
                            <fieldset>
                                <label for="remove_dns_prefetch">
                                    <?php $this->display_checkbox('remove_dns_prefetch') ?>
                                    Удалить dns-prefetch <sup class="clearfy-recommend">Рекомендовано</sup>
                                </label>
                                <p class="description">С версии 4.6.1 в WordPress появились новые ссылки в секции <code>&lt;head&gt;</code> такого вида: &lt;link rel='dns-prefetch' href='//s.w.org'&gt;</p>
                                <p class="description"><strong>Clearfy:</strong> Удаляет ссылки dns-prefetch из секции <code>&lt;head&gt;</code></p>
                            </fieldset>
                            <br>
                            <fieldset>
                                <label for="remove_rsd_link">
                                    <?php $this->display_checkbox('remove_rsd_link') ?>
                                    Удалить RSD ссылку <sup class="clearfy-recommend">Рекомендовано</sup>
                                </label>
                            </fieldset>
                            <fieldset>
                                <label for="remove_wlw_link">
                                    <?php $this->display_checkbox('remove_wlw_link') ?>
                                    Удалить WLW Manifest ссылку <sup class="clearfy-recommend">Рекомендовано</sup>
                                </label>
                            </fieldset>
                            <fieldset>
                                <label for="remove_shortlink_link">
                                    <?php $this->display_checkbox('remove_shortlink_link') ?>
                                    Удалить короткую ссылку <code>/?p=</code> <sup class="clearfy-recommend">Рекомендовано</sup>
                                </label>
                            </fieldset>
                            <fieldset>
                                <label for="remove_adjacent_posts_link">
                                    <?php $this->display_checkbox('remove_adjacent_posts_link') ?>
                                    Удалить ссылки на предыдущую, следующую запись <sup class="clearfy-recommend">Рекомендовано</sup>
                                </label>
                            </fieldset>
                            <br>
                            <fieldset>
                                <label for="remove_recent_comments_style">
                                    <?php $this->display_checkbox('remove_recent_comments_style') ?>
                                    Удалить стили .recentcomments <sup class="clearfy-recommend">Рекомендовано</sup>
                                </label>
                                <p class="description">WP по умолчанию для виджета "последние комментарии"" прописывает в коде стили, которые практически невозможно поменять, т.к. к ним применяется !important.</p>
                                <p class="description"><strong>Clearfy:</strong> Удаляет стили .recentcomments из секции <code>&lt;head&gt;</code></p>
                            </fieldset>

                            <h3>Минификация</h3>

                            <fieldset>
                                <label for="html_minify">
                                    <?php $this->display_checkbox('html_minify') ?>
                                    Включить HTML минификацию <sup><strong>NEW! beta</strong></sup>
                                </label>
                                <p class="description">Позволяет уменьшить объем страницы на 20-30% за счет удаления переносов строк, символов табуляции, пробелов и т.д. Кроме уменьшения веса страницы, это добавляет баллов в Google PageSpeed.</p>
                                <p class="description">После включения обновите кеш, если у Вас установлены плагины кеширования.</p>
                                <p class="description">JS скрипты не минифицируются в коде, т.к. в 90% случаев это приводит к поломкам.</p>
                                <p class="description">HTML комментарии не удаляются, т.к. много случаев, когда счетчики или реклама перестает работать.</p>
                                <p class="description"><strong>Clearfy:</strong> Выполняет минификацию страницы</p>
                                <p class="description danger"><small>* Редко, но случается, что на хостинге не работает (из-за характеристик сервера, php) - напишите в поддержку</small></p>
                            </fieldset>
                            <br>

                        </div>
                        <div id="clearfy_seo" class="wpshop-tab-in js-wpshop-tab-item">
                            <h3>SEO</h3>

                            <fieldset>
                                <label for="set_last_modified_headers">
                                    <?php $this->display_checkbox('set_last_modified_headers') ?>
                                    Автоматически проставить заголовок Last Modified <sup class="clearfy-recommend"><strong>NEW!</strong> Рекомендовано</sup>
                                </label>
								<div class="last-modified-text">
								    Исключить страницы:
                                    <?php $this->display_textarea_last_modified('last_modified_exclude') ?>
                                    <p class="description">Вы можете задать маску страниц, например: /s= или /cabinet/. Будут исключены все страницы, в которые входит строка.<br>Если задать <code>cart/</code> - будут исключены все страницы, содержащие cart/, в т.ч. <code>cart/process</code>, <code>order-cart/</code>, <code>check-cart/?get=action</code> и т.д.</p>
                                </div>
                                <label for="if_modified_since_headers">
                                    <?php $this->display_checkbox('if_modified_since_headers') ?>
                                    Отдавать ответ If-Modified-Since <sup class="clearfy-recommend"><strong>NEW!</strong> Рекомендовано</sup>
                                </label>
                                <p class="description">WordPress не умеет отдавать в ответах сервера заголовок Last Modified (дату последнего изменения документа) и давать правильный ответ 304 Not Modified. А этот заголовок очень важен для поисковых систем. Его наличие ускоряет индексацию, снижает нагрузку и позволяет загружать поисковикам за раз больше страниц в индекс. .</p>
                                <p class="description"><strong>Clearfy:</strong> Проставляет для всех записей, страниц, архивов (категорий, тегов и пр.) заголовок <code>Last Modified</code> и возвращает правильный ответ, если страница не была изменена.</p>
                                <p class="description danger"><small>* Срабатывает не на всех хостингах, если у Вас не отдается этот заголовок - напишите в поддержку</small></p>
                            </fieldset>
                            <br>
                            <fieldset>
                                <label for="content_image_auto_alt">
                                    <?php $this->display_checkbox('content_image_auto_alt') ?>
                                    Автоматически проставить аттрибут alt <sup class="clearfy-recommend">Рекомендовано</sup>
                                </label>
                                <p class="description">Аттрибут alt обязателен к заполнению, - так говорит большинство SEO-специалистов. Если вдруг Вы пропустили или вовсе не заполняли его, он будет проставлен автоматически и будет равен названию статьи.</p>
                                <p class="description"><strong>Clearfy:</strong> Проставляет аттрибут <code>alt</code> у изображений, где он не задан.</p>
                            </fieldset>
                            <br>
                            <fieldset>
                                <label for="comment_text_convert_links_pseudo">
                                    <?php $this->display_checkbox('comment_text_convert_links_pseudo') ?>
                                    Спрятать внешние ссылки в комментариях в JS <sup class="clearfy-recommend">Рекомендовано</sup>
                                </label>
                                <p class="description">Лишние внешние ссылки из комментариев, которых может набираться с десяток и больше всего для одной статьи, ничего хорошего для продвижения не принесут.</p>
                                <p class="description"><strong>Clearfy:</strong> Заменяет только внешние ссылки в комментариях на JS код, отличить от обычных ссылок внешне невозможно.</p>
                            </fieldset>
                            <br>
                            <fieldset>
                                <label for="pseudo_comment_author_link">
                                    <?php $this->display_checkbox('pseudo_comment_author_link') ?>
                                    Спрятать внешние ссылки авторов комментариев в JS * <sup class="clearfy-recommend">Рекомендовано</sup>
                                </label>
                                <p class="description">До 90% комментариев на блоге может быть оставлено ради внешней ссылки. Даже nofollow от утекания веса страницы тут не поможет.</p>
                                <p class="description"><strong>Clearfy:</strong> Заменяет ссылки авторов комментариев на JS код, отличить от обычных ссылок внешне невозможно.</p>
                                <p class="description danger"><small>* Может не работать с Вашей темой</small></p>
                            </fieldset>
                            <br>
                            <fieldset>
                                <label for="right_robots_txt">
                                    <?php $this->display_checkbox('right_robots_txt') ?>
                                    Создать правильный robots.txt <sup class="clearfy-recommend">Рекомендовано</sup>
                                </label>
                                <?php if ( file_exists(ABSPATH . 'robots.txt') ) { ?>
                                    <p class="description danger"><strong>Внимание! Обнаружен файл robots.txt.</strong><br>Сделайте бекап текущего файла robots.txt и удалите его, чтобы данная функция могла работать</p>
                                <?php } ?>
                                <p class="description">После установки WP не содержит файла robots.txt и его приходится создавать вручную. Мы перечитали около 30 различных статей, инструкции от Яндекса и Google, чтобы создать идеальный robots.txt</p>
                                <p class="description"><strong>Clearfy:</strong> Автоматически создает идеальный <code>robots.txt</code></p>
                                <p class="description">Вы можете изменить Ваш robots.txt в поле ниже:</p>
                                <p class="robots-text">
                                    <?php $this->display_textarea_robots('robots_txt_text') ?>
                                </p>
                            </fieldset>
                            <?php /*<br>
                            <fieldset>
                                <label for="redirect_from_https_to_http">
                                    <?php $this->display_checkbox('redirect_from_https_to_http') ?>
                                    Редирект с https на http <sup class="clearfy-recommend">Рекомендовано</sup>
                                </label>
                                <p class="description">Если Ваш сайт не использует SSL-сертификат, а это 95% случаев, имеет смысл настроить редирект с https на http для всех страниц</p>
                                <p class="description"><strong>Clearfy:</strong> Ставит редирект с https на http.</p>
                                <p class="description danger"><small>* Зависит от хостера, может не работать</small></p>
                            </fieldset>*/ ?>

                            <h3>Для плагина Yoast SEO</h3>
                            <fieldset>
                                <label for="remove_last_item_breadcrumb_yoast">
                                    <?php $this->display_checkbox('remove_last_item_breadcrumb_yoast') ?>
                                    Убрать дублирование названия в хлебных крошках WP SEO by Yoast <sup class="clearfy-recommend">Рекомендовано</sup>
                                </label>
                                <p class="description">Последний элемент в хлебных крошках в плагине Yoast SEO дублирует название статьи. Некоторые SЕО-специалисты считают это дублирование лишним.</p>
                                <p class="description"><strong>Clearfy:</strong> Добавляет возможность убрать дублирование названия в хлебных крошках плагина WP SEO by Yoast.</p>
                            </fieldset>
                            <br>
                            <fieldset>
                                <label for="yoast_remove_image_from_xml_sitemap">
                                    <?php $this->display_checkbox('yoast_remove_image_from_xml_sitemap') ?>
                                    Удалить тег &lt;image:image&gt; из XML карты сайта <sup class="clearfy-recommend"><strong>NEW!</strong> Рекомендовано</sup>
                                </label>
                                <p class="description">Яндекс.Вебмастер ругается на стандартную XML карту от плагина Yoast, т.к. в ней есть специфичный тег &lt;image:image&gt;. Подробнее у нас в блоге.</p>
                                <p class="description"><strong>Clearfy:</strong> Удаляет тег &lt;image:image&gt; из XML карты плагина Yoast SEO.</p>
                                <p class="description danger"><strong>Внимание!</strong> После активации выключите карту сайта и влючите обратно, чтобы перегенерировать её.</p>
                                <p class="description danger"><small>* На старых версиях Yoast SEO может не сработать - обновите плагин Yoast</small></p>
                            </fieldset>
                            <br>
                            <fieldset>
                                <label for="yoast_remove_head_comment">
                                    <?php $this->display_checkbox('yoast_remove_head_comment') ?>
                                    Удалить комментарий из секции &lt;head&gt; <sup class="clearfy-recommend"><strong>NEW!</strong> Рекомендовано</sup>
                                </label>
                                <p class="description">Плагин Yoast SEO выводит комментарий вида &lt;!-- This site is optimized with the Yoast SEO plugin v3.1.1 - https://yoast.com/wordpress/plugins/seo/ --&gt; в секции &lt;head&gt;</p>
                                <p class="description"><strong>Clearfy:</strong> Удаляет комментарий плагина Yoast SEO их секции &lt;head&gt;.</p>
                            </fieldset>

                        </div>
                        <div id="clearfy_double" class="wpshop-tab-in js-wpshop-tab-item">
                            <h3>Дубли страниц</h3>

                            <fieldset>
                                <label for="redirect_archives_date">
                                    <?php $this->display_checkbox('redirect_archives_date') ?>
                                    Удалить архивы дат <sup class="clearfy-recommend">Рекомендовано</sup>
                                </label>
                                <p class="description">Огромное количество дублей в архивах дат. Представьте, кроме того, что Ваша статья будет выводиться на главной и в категории, Вы еще получите как минимум 3 дубля: в архивах по году, месяцу и дате, например /2016/ /2016/02/ /2016/02/15.</p>
                                <p class="description"><strong>Clearfy:</strong> Удаляет полностью архивы дат и ставит редирект.</p>
                            </fieldset>
                            <br>
                            <fieldset>
                                <label for="redirect_archives_author">
                                    <?php $this->display_checkbox('redirect_archives_author') ?>
                                    Удалить архивы пользователей <sup class="clearfy-recommend">Рекомендовано</sup>
                                </label>
                                <p class="description">Если сайт наполняете только Вы - обязательный пункт. Позволит избавиться от дублей на архивах пользователей, например /author/admin/.</p>
                                <p class="description"><strong>Clearfy:</strong> Удаляет полностью архивы пользователей и ставит редирект.</p>
                            </fieldset>
                            <br>
                            <fieldset>
                                <label for="redirect_archives_tag">
                                    <?php $this->display_checkbox('redirect_archives_tag') ?>
                                    Удалить архивы тегов
                                </label>
                                <p class="description">Если Вы используете теги только для блока Похожие записи, либо не использете их совсем - правильнее будет их закрыть, чтобы избежать дублей.</p>
                                <p class="description"><strong>Clearfy:</strong> Ставит редирект со страниц тегов на главную.</p>
                            </fieldset>
                            <br>
                            <fieldset>
                                <label for="attachment_pages_redirect">
                                    <?php $this->display_checkbox('attachment_pages_redirect') ?>
                                    Удалить страницы вложений <sup class="clearfy-recommend">Рекомендовано</sup>
                                </label>
                                <p class="description">Каждая загруженная картинка имеет свою страничку на сайте, состоящую только из одной картинки. Такие страницы успешно индексируются и создают дубли. На сайте могут быть тысячи однотипных страниц вложений.</p>
                                <p class="description"><strong>Clearfy:</strong> Удаляет страницы вложений и ставит редирект на запись.</p>
                            </fieldset>
                            <br>
                            <fieldset>
                                <label for="remove_single_pagination_duplicate">
                                    <?php $this->display_checkbox('remove_single_pagination_duplicate') ?>
                                    Удалить дубли пагинации постов <sup class="clearfy-recommend">Рекомендовано</sup>
                                </label>
                                <p class="description">В WordPress любую запись можно разделить на части (страницы), у каждой части будет свой адрес. Но этот функционал крайне редко используется, зато может создать Вам неприятности. Например, к адресу любой записи Вашего блога можно добавить номер, /privet-mir/1/ - откроется сама запись, что будет дублем. Номер можно подставить любой.</p>
                                <p class="description"><strong>Clearfy:</strong> Ставит редирект на саму запись.</p>
                            </fieldset>
                            <br>
                            <fieldset>
                                <label for="remove_replytocom">
                                    <?php $this->display_checkbox('remove_replytocom') ?>
                                    Удалить ?replytocom <sup class="clearfy-recommend">Рекомендовано</sup>
                                </label>
                                <p class="description">WordPress добавляет ?replytocom= к ссылке Ответить в комментариях, если включены древовидные комментарии</p>
                                <p class="description"><strong>Clearfy:</strong> удаляет ?relpytocom и ставит редирект на запись</p>
                            </fieldset>

                        </div>
                        <div id="clearfy_security" class="wpshop-tab-in js-wpshop-tab-item">
                            <h3>Защита</h3>

                            <fieldset>
                                <label for="protect_author_get">
                                    <?php $this->display_checkbox('protect_author_get') ?>
                                    Убрать возможность узнать логин администратора <sup class="clearfy-recommend">Рекомендовано</sup>
                                </label>
                                <p class="description">Сменили имя пользователя с admin на другое, чтобы злоумышленники не узнали Ваш логин? Не спешите радоваться, наберите в адресной строке <code>вашсайт.ru/?author=1</code> и Вас в 90% случаев сразу перекинет на страницу автора <code>/author/alexey</code>, тем самым выдавая Ваш логин.</p>
                                <p class="description"><strong>Clearfy:</strong> Удаляет полностью архивы дат и ставит редирект.</p>
                            </fieldset>
                            <br>
                            <fieldset>
                                <label for="change_login_errors">
                                    <?php $this->display_checkbox('change_login_errors') ?>
                                    Спрятать ошибки при входе на сайт <sup class="clearfy-recommend">Рекомендовано</sup>
                                </label>
                                <p class="description">WP по умолчанию показывает, ввели ли Вы неправильный логин или неправильный пароль, что дает злоумышленникам понять, существует ли определенный пользователь на сайте, а после начать перебор паролей.</p>
                                <p class="description"><strong>Clearfy:</strong> Меняет текст ошибки так, чтобы злоумышленники не смогли подобрать логин.</p>
                            </fieldset>
                            <br>
                            <fieldset>
                                <label for="remove_x_pingback">
                                    <?php $this->display_checkbox('remove_x_pingback') ?>
                                    Убрать ссылку на X-Pingback и возможность спамить pingback'ами <sup class="clearfy-recommend">Рекомендовано</sup>
                                </label>
                                <p class="description">Одной из причин, по которым Ваш сайт на WP стал тормозить, является атака на сайт, при которой идет большое количество запросов к файлу xmlrpc.php, который отвечает за pingback'и, удаленный доступ к WP. Через файл xmlrpc.php может идти DDoS или Брутфорс-атака.</p>
                                <p class="description"><strong>Clearfy:</strong> Удаляет в ответах сервера ссылку на xmlrpc.php, закрывает возможность спамить сайт pingback'ами.</p>
                            </fieldset>

                        </div>
                        <div id="clearfy_more" class="wpshop-tab-in js-wpshop-tab-item">
                            <h3>Дополнительно</h3>

                            <fieldset>
                                <label for="disable_feed">
                                    <?php $this->display_checkbox('disable_feed') ?>
                                    Отключить ленты RSS
                                </label>
                                <p class="description">Основная дыра, откуда будут парсить Ваш контент, - RSS-ленты. Для статейных сайтов, сайтов-визиток, корпоративных сайтов - отключать обязательно.</p>
                                <p class="description"><strong>Clearfy:</strong> Удаляет ссылку на RSS-ленту из секции &lt;head&gt;, закрывает и ставит редирект со всех RSS-лент.</p>
                            </fieldset>
                            <br>
                            <fieldset>
                                <label for="remove_url_from_comment_form">
                                    <?php $this->display_checkbox('remove_url_from_comment_form') ?>
                                    Убирает в форме комментирования поле «Сайт»
                                </label>
                                <p class="description">Надоел спам в комментариях? Посетители оставляют «пустые» комментарии ради ссылки на свой сайт?</p>
                                <p class="description"><strong>Clearfy:</strong> Убирает поле «Сайт» из формы комментирования.</p>
                                <p class="description danger"><small>* Работает со стандартной формой комментирования, если в Вашей теме форма прописана вручную - скорей всего не сработает!</small></p>
                            </fieldset>
                            <br>
                            <fieldset>
                                <label for="remove_unnecessary_link_admin_bar">
                                    <?php $this->display_checkbox('remove_unnecessary_link_admin_bar') ?>
                                    Убирает ссылки на сайт wordpress.org из админ бара <sup class="clearfy-recommend">Рекомендовано</sup>
                                </label>
                                <p class="description">Первым пунктом в панели инструментов идет логотип wordpress'а и внешние ссылки на сайты wordpress.org, документацию и форумы WP.</p>
                                <p class="description"><strong>Clearfy:</strong> Убирает все ссылки на wordpress.org из панели инструментов.</p>
                            </fieldset>

                            <h3>Виджеты</h3>
                            <fieldset>
                                <label for="remove_unneeded_widget_page">
                                    <?php $this->display_checkbox('remove_unneeded_widget_page') ?>
                                    Убрать виджет "Страницы"
                                </label>
                                <br>
                                <label for="remove_unneeded_widget_calendar">
                                    <?php $this->display_checkbox('remove_unneeded_widget_calendar') ?>
                                    Убрать виджет "Календарь"
                                </label>
                                <br>
                                <label for="remove_unneeded_widget_tag_cloud">
                                    <?php $this->display_checkbox('remove_unneeded_widget_tag_cloud') ?>
                                    Убрать виджет "Облако меток"
                                </label>
                                <br>
                                <p class="description">Виджеты "Страницы", "Календарь", "Облако меток" создают по лишнему запросу к базе данных, а используются сейчас крайне редко, т.к. "Страницы" легко заменяются виджетом "Меню", а два других только создают дубли страниц.</p>
                                <p class="description"><strong>Clearfy:</strong> Отключает эти виджеты, уменьшая количество запросов к базе данных.</p>
                            </fieldset>

                            <h3>Ревизии</h3>
                            <label for="revisions_disable">
                                <?php $this->display_checkbox('revisions_disable') ?>
                                Отключить ревизии полностью
                            </label>
                            <br><br class="clear">

                            <div class="clearfy-settings-item">
                                <label for="">Ограничить количество ревизий</label>
                                <?php $this->display_input_number('revision_limit', 1, 0) ?>
                                <br class="clear">
                                <?php
                                    $check_config_revisions = file_get_contents( get_home_path() . 'wp-config.php' );
                                    if ( preg_match('/define(.+?)WP_POST_REVISIONS/', $check_config_revisions) ) {
                                        echo '<p class="description danger">Внимание! В файле wp-config.php найдена константа WP_POST_REVISIONS, она определяет количество ревизий. Удалите её, чтобы Вы могли менять это значение через админку.</p>';
                                    }
                                ?>

                                <p class="description">При сохранении и обновлении любой записи или страницы создается её копия (ревизия), которую в будущем можно посмотреть или восстановить. Но со временем большое количество таких ревизий (а их может быть десятки для каждой страницы) забивают базу данных, расходуя место и замедляя работу. Обычно достаточно хранить до 3-5 последних ревизий.</p>
                            </div>

                        </div>

                        <?php submit_button(); ?>

                    </form>

                </div><!--.wpshop-col-left-->


                <div class="wpshop-col-right">

                    <?php $this->display_widgets(); ?>

                </div>


            <?php endif; //license key ?>

        </div>

        <?php
    }



    public function display_widgets() {
        ?>

        <?php
            $wpshop_widget_info = get_transient( 'wpshop_widget_info' );
            if ( false === $wpshop_widget_info ) {
                //$wpshop_widget_info = @file_get_contents('https://wpshop.ru/api.php');
                //set_transient('wpshop_widget_info', $wpshop_widget_info, 60 * 60 * 3);
            }
        ?>

        <?php
    }


    /**
     * Display option checkbox
     *
     * @param string $name
     */
    public function display_checkbox( $name ) {
        $checked = '';
        if (isset($this->options[$name]) && $this->options[$name] == 'on') $checked = ' checked';
        $string = '<input name="' . $this->option_name . '[' . $name . ']" type="checkbox" id="' . $name . '" value="on"'. $checked .'>';
        echo $string;
    }

    /**
     * Display input text field
     *
     * @param string $name
     */
    public function display_input_text( $name ) {
        $value = '';
        if (isset($this->options[$name]) && ! empty($this->options[$name])) $value = $this->options[$name];
        $string = '<input name="' . $this->option_name . '[' . $name . ']" type="text" id="' . $name . '" value="'. $value .'"" class="regular-text">';
        echo $string;
    }

    /**
     * Display textarea field
     *
     * @param string $name
     */
    public function display_textarea_robots( $name ) {
        $value = '';
        if (isset($this->options[$name]) && ! empty($this->options[$name])) $value = $this->options[$name];
        if ( empty( $value ) ) {
            $plugin = new Clearfy_Plugin();
            $value = $plugin->right_robots_txt( '' );
            //$value = Clearfy_Plugin::right_robots_txt( '' );
        }
        $string = '<textarea name="' . $this->option_name . '[' . $name . ']" id="' . $name . '" class="regular-text">'. $value .'</textarea>';
        echo $string;
    }
	
	public function display_textarea_last_modified( $name ) {
        $value = '';
        if (isset($this->options[$name]) && ! empty($this->options[$name])) $value = $this->options[$name];
        $string = '<textarea name="' . $this->option_name . '[' . $name . ']" id="' . $name . '" class="regular-text" rows="4">'. $value .'</textarea>';
        echo $string;
    }

    /**
     * Display input number field
     *
     * @param $name
     * @param $step
     * @param $min
     * @param $max
     */
    public function display_input_number( $name , $step = '', $min = '', $max = '' ) {
        $value = '';
        if (isset($this->options[$name]) && ! empty($this->options[$name])) $value = $this->options[$name];
        $string  = '<input name="' . $this->option_name . '[' . $name . ']" type="number" ';
        if (!empty($step)) $string .= 'step="'. $step .'" ';
        if (!empty($min) || $min === 0)  $string .= 'min="'. $min .'"  ';
        if (!empty($max))  $string .= 'max="'. $max .'" ';
        $string .= 'id="' . $name . '" value="'. $value .'"" class="small-text">';
        echo $string;
    }

    /**
     * Display select
     *
     * @param string $name
     * @param array $values
     */
    public function display_select( $name , $values ) {
        if (isset($this->options[$name]) && ! empty($this->options[$name])) $value = $this->options[$name];
        $string  = '<select name="' . $this->option_name . '[' . $name . ']" id="' . $name . '">';

        if (is_array( $values )) {
            foreach ($values as $key => $value) {
                $selected = '';
                if (isset($this->options[$name]) && $this->options[$name] == $key) $selected = ' selected';

                $string .= '<option value="' . $key . '"'. $selected .'>' . $value . '</option>';
            }
        }

        $string .= '</select>';
        echo $string;
    }
}
