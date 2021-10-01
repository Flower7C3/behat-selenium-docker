# Testing with Behat on Selenium at Docker

## 1. Installation

1. Install [Docksal](https://docksal.io) *(required only once, but please update it sometimes)*.
2. Run `fin init` command in project root directory *(required only once, see note below)* to initialize and start Docker stack (containers, volumes and network).



## 2. Usage

- `fin test` - execute behat tests on Selenium from `features/` directory
- `fin tt TAG_NAME` - execute behat tests on Selenium by `TAG_NAME` (see below)
- `fin tl` - execute behat tests on Selenium and save result in `screenshots/$DATETIME/` directory
- `fin start` - to start Docker stack (containers, volumes and network)
- `fin stop` - to stop Docker stack (containers, volumes and network)
- `fin project remove` - to remove all Docker components (containers, volumes and network)


## 3. Run specific test

Run `fin tt TAG_NAME` command, where `TAG_NAME` is tag name defined in PHP test files.
Most important tags:
- `@user_forms_error`
- `@update_user_profile_process`
- `@user_register_account_level1_ok`
- `@user_register_account_level2_ok`
- `@webinar_create`
- `@webinar_open`
- `@new_user_watch_webinar_process`


## 4. See what Selenium are doing

1. Define `SELENIUM_DEBUG="-debug"` in `.docksal/docksal-local.env` file and run `fin start` command.
2. Open VNC viewer with `fin vnc` command.


## 5. Customize Selenium

In `.docksal/docksal-local.env` file define variables: 
- `SELENIUM_BROWSER_NAME` and `SELENIUM_DEBUG` - browser name, lookup for one at [hub.docker.com](https://hub.docker.com/search?q=selenium%2Fstandalone-&type=image).
- `SELENIUM_PORT`, default: 4444
- `SELENIUM_VNC_PORT`, default: 5900
- `SELENIUM_SCREEN_WIDTH`, default: 1366
- `SELENIUM_SCREEN_HEIGHT`, default: 768
- `SELENIUM_SCREEN_DEPTH`, default: 24
- `SELENIUM_SCREEN_DPI`, default: 74

> When You made some changes please recreate Docker stack with `fin start` command.


## 6. Write custom tests

Read [behat mink documentation](https://docs.behat.org/en/v2.5/cookbook/behat_and_mink.html).


## 7. Troubleshooting

1. For *ERROR: for selenium  Cannot start service selenium: Ports are not available: listen tcp 0.0.0.0:5900: bind: address already in use* please define `SELENIUM_VNC_PORT` in `.docksal/docksal-local.yml` file.
