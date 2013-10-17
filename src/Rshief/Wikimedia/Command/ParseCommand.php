<?php

namespace Rshief\Wikimedia\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ParseCommand
 * @package Rshief\Command
 */
class ParseCommand extends Command
{
    public function __construct($name = null)
    {
        parent::__construct($name);

    }

    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this
            ->setName('mediawiki:parse')
            ->setDefinition($this->createDefinition())
            ->setDescription('Parse wikimedia to HTML')
            ->addArgument('filename')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $parser = new \Parser();
        $wikimarkup = '';
        $filename = $input->getArgument('filename');

        if (!$filename) {
            if (0 !== ftell(STDIN)) {
                throw new \RuntimeException("Please provide a filename or pipe template content to stdin.");
            }

            while (!feof(STDIN)) {
                $wikimarkup .= fread(STDIN, 1024);
            }
        } else {
            $wikimarkup = file_get_contents($filename);
        }
        $wikimarkup .= PHP_EOL;

        $result = $parser->parse($wikimarkup, new \Title(), new \ParserOptions());
        $result->setEditSectionTokens(false);
        echo $result->getText();
    }

    /**
     * {@inheritdoc}
     */
    private function createDefinition()
    {
        return new InputDefinition(array(
        ));
    }
}
