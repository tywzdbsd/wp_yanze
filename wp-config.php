<?php
/**
 * WordPress基础配置文件。
 *
 * 本文件包含以下配置选项：MySQL设置、数据库表名前缀、密钥、
 * WordPress语言设定以及ABSPATH。如需更多信息，请访问
 * {@link http://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 * 编辑wp-config.php}Codex页面。MySQL设置具体信息请咨询您的空间提供商。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以手动复制这个文件，并重命名为“wp-config.php”，然后填入相关信息。
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */
define('DB_NAME', 'wordpressDB');

/** MySQL数据库用户名 */
define('DB_USER', 'root');

/** MySQL数据库密码 */
define('DB_PASSWORD', '000000');

/** MySQL主机 */
define('DB_HOST', 'localhost');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8mb4');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/
 * WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'c;l5T|eT_bA;&N|;|AY^Omskwn=*MT{E:rweJd<A2K<{eemwU/XH&Cs78:2Q,=<A');
define('SECURE_AUTH_KEY',  'V-|OZY0/[:;kn$Fvnco}cmQS_4b^t$KnM|(j8Y6 %t`DvE8X->v._/=|6VQP+, R');
define('LOGGED_IN_KEY',    'a+w%xRO2YAMdaS~N1{d%EHgd;x~yK3ZAPO|(SrLsR/+7.~?FA-h~an_Q:Con)aNo');
define('NONCE_KEY',        '[3Hv9uMD_pTdNf&,fqGL*?b.ysJjAh6nHeaV@`}@Ls+1&vwNOAC(dk,Os!&<BVyT');
define('AUTH_SALT',        '%fIM|ppiZae]$dw@Bz 01f|+@SAkHM9PJ|zb6k8{1Htu6;7YFr [@RV,<g+U)5We');
define('SECURE_AUTH_SALT', 'a[6.w7gX<i~E5`+-de7pOw,-<[s;#f@|V.V0w0r)W.VAG`)5f$yFRy}e08C^lDb.');
define('LOGGED_IN_SALT',   '[.`9q+Sy,Xb[#Aa(Y&!Q?G1u||Y7)d-}^ZuuN<]RODB}#J |V/X$9~Y-N.dGyi]G');
define('NONCE_SALT',       '23m$IDn[{mbh!X2v:8<SO;+SozDX]~U0p?!*oBq%300<jthc|0MsbYk}Xk3`8j[q');

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'wp_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 */
define('WP_DEBUG', false);

/**
 * zh_CN本地化设置：启用ICP备案号显示
 *
 * 可在设置→常规中修改。
 * 如需禁用，请移除或注释掉本行。
 */
define('WP_ZH_CN_ICP_NUM', true);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** 设置WordPress变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');
