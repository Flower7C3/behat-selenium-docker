### Docksal

### Installation
1. Install [Docksal](https://docksal.io) *(required only once, but please update it sometimes)*.
2. Run `fin init` command in project root directory *(required only once, see note below)*.
3. Run `fin test` to execute tests from `tests/` directory using [lmc-eu/steward](https://github.com/lmc-eu/steward).


### Run specific test

- Add `--suite NAME` argument to `fin test` command, where `NAME` is @suite name defined in `behat.yml` files.
- Add `--tags @tag` argument to `fin test` command, where `@tag` is tag name defined in PHP test files.

To see more options just run `fin test --help` command.


### Customize Selenium

In `.docksal/docksal-local.env` file define variables: 
- `SELENIUM_STANDALONE_BROWSER` - browser name, lookup for one at [hub.docker.com](https://hub.docker.com/search?q=selenium%2Fstandalone-&type=image).
- `SELENIUM_PORT`
- `SELENIUM_VNC_PORT`

> When You made some changes please recreate Docker stack with `fin start` command.
