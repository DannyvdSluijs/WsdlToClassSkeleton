<?php
/**
 * wsdlToClass
 *
 * PHP Version 5.3
 *
 * @copyright 2016 Danny van der Sluijs <danny.vandersluijs@icloud.com>
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU-GPL
 * @link      http://dannyvandersluijs.nl
 */

namespace WsdlToClassSkeleton\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *
 */
class ForecastCommand extends Command {

    protected function configure()
    {
        $this->setName("weather:forecast")
             ->setDescription("Show the weather forecast")
             ->setDefinition(array(
            ))
             ->setHelp(<<<EOT
Usage:

<info>./WsdlToClassSkeleton weather:forecast</info>
EOT
);
    }

    /**
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $zip = '95014';
        $client = new \WsdlToClassSkeleton\Soap\Client();

        $request = new \WsdlToClassSkeleton\Soap\Request\GetCityWeatherByZIP();
        $request->ZIP = $zip;

        $response = $client->GetCityWeatherByZIP($request);
        $weather = $response->GetCityWeatherByZIPResult;

        $output->writeln(sprintf('Weather for: %s %s %s', $weather->City, $weather->State, $zip));
        $output->writeln(sprintf('Currently it is %s with a temperature of %s degrees', strtolower($weather->Description), $weather->Temperature));
    }
}
