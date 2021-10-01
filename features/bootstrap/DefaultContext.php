<?php
/** @noinspection UnknownInspectionInspection */

/** @noinspection PhpUnused */

use Behat\Mink\Exception\DriverException;
use Behat\Mink\Exception\UnsupportedDriverActionException;
use Behat\MinkExtension\Context\MinkContext;
use Faker\Factory;

class DefaultContext extends MinkContext
{
    protected \Faker\Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    /**
     * @Then /^(?:|I )maximize window$/
     */
    public function maximizeWindow(): void
    {
        $this->getMink()->getSession()->maximizeWindow();

    }

    /**
     * @Then /^(?:|I )go to and press "(?P<name>(?:[^"]|\\")*)"$/
     * @param string $name
     * @throws DriverException
     * @throws UnsupportedDriverActionException
     */
    public function goToAndPress(string $name): void
    {
        $button = $this->getSession()->getPage()->findButton($name);
        $element = '#' . $button->getAttribute('id');
        $this->scrollToElement($element);
        $this->pressButton($name);
    }

    /**
     * @Then /^(?:|I )scroll to "(?P<element>(?:[^"]|\\")*)" element$/
     * @param string $element
     * @throws DriverException
     * @throws UnsupportedDriverActionException
     */
    public function scrollToElement(string $element): void
    {
        self::debug(sprintf('Scroll to "%s" element', $element));
        $script = null;
        if (strpos($element, '#') === 0) {
            $script = "document.getElementById('" . substr($element, 1) . "').scrollIntoView({'block':'center'})";
        } elseif (strpos($element, '.') === 0) {
            $script = "document.getElementsByClassName('" . substr($element, 1) . "')[0].scrollIntoView({'block':'center'})";
        }
        if ($script) {
            $this->getSession()->getDriver()->evaluateScript($script);
        }
    }

    protected static function debug($data): void
    {
        $bt = debug_backtrace();
        $caller = array_shift($bt);
        $location = $caller['file'] . ':' . $caller['line'];
        print $location . ' » ';
        if (is_string($data)) {
            print $data;
        } else {
            print var_export($data, true);
        }
        print PHP_EOL;
        ob_flush();
    }
}
