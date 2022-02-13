<?php

namespace Gaiththewolf\JasperReportClient;

use Illuminate\Http\Response;
use Jaspersoft\Client\Client;

class JasperReportClient
{

    // https://community.jaspersoft.com/wiki/php-client-sample-code

    /** @var Client */
    private $jasperClient;

    private $reportService;

    public function __construct(string $base_url, string $username, string $password, $jrs_org_id = null)
    {
        $this->jasperClient = new Client($base_url, $username, $password, $jrs_org_id);
        $this->jasperClient->setRequestTimeout(60);
        $this->reportService = $this->jasperClient->reportService();
    }

    /**
     * @param string $reportUnit
     * @param array $params
     * @param string $filename
     * @param string $format
     * @param int $page
     * @return Illuminate\Http\Response
     */
    public function generate($reportUnit, $params = array(), $filename = "Report", $format = "pdf", $page = 1)
    {
        switch ($format) {
            case 'html':
                return $this->reportService->runReport($reportUnit, $format, $page, null, $params);
            case 'xml':
            case 'pdf':
                $report = $this->reportService->runReport($reportUnit, $format, null, null, $params);
                $response = new Response($report);

                $response->headers->set('Cache-Control', 'must-revalidate');
                $response->headers->set('Pragma', 'public');
                $response->headers->set('Content-Description', 'File Transfer');
                $response->headers->set('Content-Disposition', 'inline; filename=' . $filename . '.' . $format);
                $response->headers->set('Content-Transfer-Encoding', 'binary');
                $response->headers->set('Content-Length', strlen($report));
                $response->headers->set('Content-Type', 'application/' . $format);
                break;
            case 'xlsx':
            case 'xls':
            case 'rtf':
            case 'csv':
            case 'odt':
            case 'docx':
            case 'ods':
            case 'pptx':
                $report = $this->reportService->runReport($reportUnit, $format, null, null, $params);
                $response = new Response($report);

                $response->headers->set('Cache-Control', 'must-revalidate');
                $response->headers->set('Pragma', 'public');
                $response->headers->set('Content-Description', 'File Transfer');
                $response->headers->set('Content-Disposition', 'attachment; filename=' . $filename . '.' . $format);
                $response->headers->set('Content-Transfer-Encoding', 'binary');
                $response->headers->set('Content-Length', strlen($report));
                $response->headers->set('Content-Type', 'application/' . $format);
                break;
            default:
                $response = new Response("Sorry file format " . $format . " is not supported.");
                break;
        }
        return $response;
    }

    /**
     * @param string $reportUnit
     * @return array
     */
    public function getReportInputControls($reportUnit)
    {
        return $this->reportService->getReportInputControls($reportUnit);
    }
}
