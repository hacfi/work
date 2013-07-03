<?php

namespace hacfi\WorkBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GithubIssuesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('github:issues')
            ->setDescription('List issues');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var \Github\Api\CurrentUser $githubApi */
        $githubApi = $this->getContainer()->get('hacfi_work.github.api.currentuser');

        $page = 1;
        do {
            $issues = $githubApi->issues(array('page' => $page));

            foreach ($issues as $issue) {
                //var_dump($issue);exit;
                $output->writeln(sprintf('<fg=cyan>%s</fg=cyan><fg=magenta>#%s</fg=magenta> %s', $issue['repository']['full_name'], $issue['number'], $issue['title']));
            }

            $page++;

        } while (count($issues) === 30);

    }
}
