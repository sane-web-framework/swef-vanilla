

-- SWEF VANILLA DATA --

INSERT IGNORE INTO `swef_config_api` (`api_Procedure`, `api_Context_Preg_Match`, `api_Num_Args`, `api_Usergroup_Preg_Match`, `api_Description`) VALUES
('apiOptions',  '<^.*$>', 0,  '<^.*$>', 'apiOptions (): returns an array of available public-facing procedures'),
('apiOptionsDashboard', '<^dashboard$>',  0,  '<^.*$>', 'apiOptionsDashboard (): returns an array of available dashboard procedures [note that the dashboard API cannot be called before a successful login because the framework insists that login happens first in a dashboard context).'),
('apiPlugins',  '<^dashboard$>',  0,  '<^sysadmin$>', 'apiPlugins (): returns a list of plugin data to system administrators'),
('apiShortcuts',  '<^.*$>', 1,  '<^.*$>', 'apiShortcuts ([match]) : returns a list of public shortcut URIs using SQL LIKE comparison'),
('apiTestNotAllowed', '<^(api|www-.*)$>', 0,  '<^bigcheese$>',  'Example, no arguments, only usergroup bigcheese allowed...'),
('swefUUID',  '<^(api|www-.*)$>', 0,  '<^public$>', 'swefUUID (): return a database-generated UUID for general use (authenticated users only)');

INSERT IGNORE INTO `swef_config_context` (`context_Enabled`, `context_Priority`, `context_Language`, `context_Context`, `context_SERVER_key`, `context_Match_Value_Preg`, `context_Endpoint_Home`, `context_Login_Always`, `context_Login_On_403`, `context_User_Must_Be_Verified`) VALUES
(1, 0,  'en-gb',  'api',  'HTTP_HOST',  '<^api\\..*$>', 'api',  0,  0,  1),
(1, 0,  'en-gb',  'dashboard',  'HTTP_HOST',  '<^dashboard\\..*$>', 'dashboard.home', 1,  0,  1),
(1, 1000, 'en-gb',  'www-en', 'HTTP_HOST',  '<^www\\..*$>', 'www.home', 0,  1,  1),
(1, 0,  'fr-fr',  'www-fr', 'HTTP_HOST',  '<^www\\.fr\\..*$>',  'www.home', 0,  1,  1);

INSERT IGNORE INTO `swef_config_context_property` (`property_Context`, `property_Set_Password_Preg_Match`) VALUES
('api', '^(.{0,7}|[^0-9]*|[^a-z]*|[a-zA-Z0-9]*)$'),
('dashboard', '^(.{0,9}|[^0-9]*|[^A-Z]*|[^a-z]*|[a-zA-Z0-9]*)$'),
('www', '^(.{0,7}|[^0-9]*|[^a-z]*|[a-zA-Z0-9]*)$');

INSERT IGNORE INTO `swef_config_filter` (`filter_Name`, `filter_Filter`, `filter_Preg_Match`, `filter_Value_Min`, `filter_Value_Max`, `filter_Length_Min`, `filter_Length_Max`) VALUES
('className', '', '<^[\\\\A-Za-z]*$>',  '', '', 1,  64),
('context', '', '<^[A-Za-z0-9\\-]*$>',  '', '', 1,  64),
('datetimeISO8601', '', '<^\\d{4}-\\d{2}-\\d{2}T\\d{2}:\\d{2}:\\d{2}\\+\\d{2}:\\d{2}$>',  '', '', 0,  0),
('dbBoolean', '', '<^(0|1)$>',  '', '', 0,  0),
('dbIdentifier',  '', '<^[0-9a-zA-Z$_]*$>', '', '', 1,  64),
('displayName', '', '<^[^\\s].*$>', '', '', 3,  64),
('email', 'FILTER_VALIDATE_EMAIL',  '', '', '', 5,  255),
('int10', 'FILTER_VALIDATE_INT',  '', '-9999999999',  '+9999999999',  1,  11),
('int10Positive', 'FILTER_VALIDATE_INT',  '', '0',  '+9999999999',  1,  11),
('languageCode',  '', '<^[A-Za-z0-9\\-]*$>',  '', '', 2,  64),
('shortcut',  '', '<^[A-Za-z0-9%]*$>',  '', '', 3,  255),
('string1-255', '', '', '', '', 1,  255),
('string1-64',  '', '', '', '', 1,  64),
('usergroup', '', '<^[a-z]+$>', '', '', 1,  64),
('uuid',  '', '<^[0-9a-f\\-]*$>', '', '', 36, 255),
('uuidOrEmpty', '', '<^[0-9a-f\\-]*$>', '', '', 0,  255);

INSERT IGNORE INTO `swef_config_input`
    (`input_Procedure`, `input_Arg`, `input_Filter_Name`)
  VALUES
    ( 'apiShortcuts',           1,  'shortcut'      ),
    ( 'swefMembershipsLoad',    1,  'email'         ),
    ( 'swefPluginFetch',        1,  'className'     ),
    ( 'swefPluginsList',        1,  'context'       ),
    ( 'swefShortcutFetch',      1,  'context'       ),
    ( 'swefShortcutFetch',      2,  'shortcut'      ),
    ( 'swefSPCode',             1,  'dbIdentifier'  ),
    ( 'swefSPsStatus',          1,  'dbIdentifier'  ),
    ( 'swefUserAuthenticate',   1,  'email'         );

INSERT IGNORE INTO `swef_config_router` (`router_Context_LIKE`, `router_Endpoint_Preg_Match`, `router_Usergroup_Preg_Match`) VALUES
('%', '<^api$>',  '<^(.*)$>'),
('%', '<^global\\..*$>',  '<^(.*)$>'),
('dashboard', '<^dashboard\\..*$>', '<^(sysadmin|admin)$>'),
('dashboard', '<^sysadmin\\..*$>',  '<^sysadmin$>'),
('www-%', '<^widget\\..*$>',  '<^(public|anon)$>'),
('www-%', '<^www\\..*$>', '<^public$>'),
('www-%', '<^www\\.anon\\..*$>',  '<^(public|anon)$>'),
('www-%', '<^www\\.home$>', '<^(public|anon)$>');

INSERT IGNORE INTO `swef_config_template` (`template_Priority`, `template_Context_LIKE`, `template_Endpoint_Preg_Match`, `template_Needs_Script`, `template_Content_Type`, `template_Template_Backreferenced`) VALUES
(4, '%',  '<^api$>',  1,  'text/plain; charset=UTF-8',  'json/api.json'),
(1, '%',  '<^api\\.cors$>', 0,  'text/plain; charset=utf-8',  '/json/api.cors.php'),
(3, '%',  '<^global\\.(.*)$>',  0,  'text/html; charset=UTF-8', 'html/global.$1.html'),
(1, '%',  '<^global\\.humans$>',  0,  'test/plain; charset=UTF-8',  'txt/global.humans.txt'),
(1, '%',  '<^global\\.robots$>',  0,  'text/plain; charset=UTF-8',  'txt/global.robots.txt'),
(3, '%',  '<^widget\\.(.*)$>',  0,  'text/html; charset=UTF-8', 'html/widget.$1.html'),
(4, 'dashboard',  '<^.*$>', 1,  'text/html; charset=UTF-8', 'html/dashboard.default.html'),
(2, 'dashboard',  '<^dashboard\\.(.*)$>', 0,  'text/html; charset=utf8',  'html/dashboard.$1.html'),
(4, 'www-%',  '<^www\\..*$>', 1,  'text/html; charset=UTF-8', 'html/www.default.html'),
(0, 'www-%',  '<^www\\.google_analytics$>', 0,  'text/html; charset=UTF-8', 'html/www.google_analytics.html'),
(0, 'www-%',  '<^www\\.js$>', 0,  'text/html; charset=UTF-8', 'html/www.js.html');

INSERT IGNORE INTO `swef_config_usergroup` (`usergroup_Usergroup`, `usergroup_Priority`, `usergroup_Db_User`, `usergroup_Name_Display`) VALUES
('admin', 1,  'swef-admin', 'Administrators'),
('anon',  9,  'swef-anon',  'Unknown Users'),
('public',  8,  'swef-public',  'Public Users'),
('sysadmin',  0,  'swef-sysadmin',  'System Administrators');

INSERT IGNORE INTO `swef_membership` (`membership_UUID`, `membership_Usergroup`) VALUES
('fa58e4c3-c3f1-11e7-beba-d8d3859a9e13',  'anon'),
('fa5b03f7-c3f1-11e7-beba-d8d3859a9e13',  'sysadmin'),
('fa5b07a2-c3f1-11e7-beba-d8d3859a9e13',  'public');

INSERT IGNORE INTO `swef_shortcut` (`shortcut_Is_System`, `shortcut_Context_LIKE`, `shortcut_Shortcut_URI`, `shortcut_Endpoint_URI`) VALUES
(1, 'dashboard',  '/403', '/dashboard.login'),
(1, 'dashboard',  '/404', '/dashboard.home'),
(0, 'dashboard',  '/humans.txt',  '/global.humans'),
(1, 'dashboard',  '/login', '/dashboard.home'),
(1, 'dashboard',  '/logout',  '/dashboard.home'),
(1, 'dashboard',  '/resource',  '/dashboard.home'),
(0, 'dashboard',  '/robots.txt',  '/global.robots'),
(1, 'www-%',  '/403', '/www.home'),
(1, 'www-%',  '/404', '/www.home'),
(0, 'www-%',  '/humans.txt',  '/global.humans'),
(1, 'www-%',  '/logout',  '/www.home'),
(1, 'www-%',  '/resource',  '/www.home'),
(0, 'www-%',  '/robots.txt',  '/global.robots');

INSERT IGNORE INTO `swef_user` (`user_Verified`, `user_UUID`, `user_Email`, `user_Password_Hash`, `user_Name_Display`) VALUES
(1, 'fa58e4c3-c3f1-11e7-beba-d8d3859a9e13', '', '', 'Anonymous'),
(1, 'fa5b03f7-c3f1-11e7-beba-d8d3859a9e13', 'mark.page@whitelamp.com',  '$2y$10$hLSdApW6.30YLK3ze49uSu7OV0gmS3ZT65pufxDPGiMxsmW3bykeq', 'Sysadmin 1'),
(1, 'fa5b07a2-c3f1-11e7-beba-d8d3859a9e13', 'test.1@no.where',  '$2y$10$hLSdApW6.30YLK3ze49uSu7OV0gmS3ZT65pufxDPGiMxsmW3bykeq', 'Test User 1');
