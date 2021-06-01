#!/usr/bin/env php

<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\SingleCommandApplication;
use Symfony\Component\DomCrawler\Crawler;

(new SingleCommandApplication())
    ->setName('Scrapp emails') // Optional
    ->setVersion('1.0.0') // Optional
//    ->addArgument('foo', InputArgument::OPTIONAL, 'The directory')
//    ->addOption('verbose', null, InputOption::VALUE_REQUIRED)
    ->setCode(function (InputInterface $input, OutputInterface $output) {
        $startUrl = 'http://www.guiadelaindustria.com.py/search?query=metalurgica&ciudad=asuncion&empresa_tiene%5B%5D=email&empresa_tiene%5B%5D=url';

        if ($input->getOption('verbose')) {
            $output->writeln('Starting the scrapping');
            $output->writeln('Start URL = '.$startUrl);
        }
        $crawler = new Crawler(file_get_contents($startUrl));
        $crawler
            ->filter('h5 > a')
            ->each(function(Crawler $node) use ($output, $input) {
                $internalUrl = $node->link()->getUri();
                if ($input->getOption('verbose')) {
                    $output->writeln('Crawling '.$internalUrl);
                }
                $internalCrawler = new Crawler(file_get_contents($internalUrl));
                $email = substr($internalCrawler
                    ->filter('.info > a')
                    ->first()
                    ->link()
                    ->getUri(), strlen('mailto:'));
                $output->writeln($email);
            });
    })
    ->run();