<?php

namespace hacfi\WorkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        /** @var \Github\Api\CurrentUser $githubApi */
        $api = $this->get('hacfi_work.github.api.currentuser');

        $issues = array();
        $page   = 1;
        do {
            $loadedIssues = $api->issues(array('page' => $page));

            foreach ($loadedIssues as $loadedIssue) {
                $issues[] = $loadedIssue;
            }

            $page++;
        } while (count($loadedIssues) === 30);

        $repositories = $api->repositories();


        /** @var \hacfi\WorkBundle\Service\GithubApiFactory $githubApi */
        $githubApi = $this->get('hacfi_work.github.api');

        $lastResponse = $githubApi->getClient()->getHttpClient()->getLastResponse();
        //$lastResponse->getApiLimit();


        return $this->render(
            'hacfiWorkBundle:Dashboard:index.html.twig',
            array(
                'name'            => 'howdy',
                'repositories'    => $repositories,
                'issues'          => $issues,
                //'calls_remaining' => $lastResponse->remainingCalls
            )
        );
    }
}
